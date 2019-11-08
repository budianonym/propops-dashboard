import pandas as pd
import sys
import datetime as dt
import pymysql
import os
import csv

reload(sys)
sys.setdefaultencoding('utf-8')

con = pymysql.connect(host='radbw2a-cluster.cluster-ro-cqyy7fkqd6u0.us-west-2.rds.amazonaws.com',user='ydina',password='k^c69h=Nzxcn8?Nt',database='radb')
cur = con.cursor()

def get_data_db(nid):
    query = """select node.nid, users.uid, if(ifnull(dc.field_disable_calendar_value, 0) = 1, "blocked", "open") cas from node
                left join users on users.uid = node.uid
                left join field_data_field_disable_calendar dc on dc.entity_id = node.nid 
                where node.nid in ({0}) group by node.nid""".format(nid)
    cur = con.cursor(pymysql.cursors.DictCursor)
    cur.execute(query)
    val = cur.fetchall()
    return val
    
def get_alldate(d1,d2):
    val = []
    ix = d2 - d1
    for i in range(ix.days+1):
        dat = d1 + dt.timedelta(days=i)
        val.append(dat.replace(hour=0, minute=0, second=0, microsecond=0))
    return val
    
def get_availability(df4, interval_days, nid):
    now = dt.datetime.today().replace(hour=0, minute=0, second=0, microsecond=0)
    df4.index = range(len(df4))
    coldf4 = list(df4.columns.values)
    df6 = df4.copy()
    for j in range(len(df6)):
        d1 = df4.loc[j,'book_start']
        d2 = df4.loc[j,'book_end']
        if d1 < now < d2:
            df6['book_start'][j] = now
        if d2 > (now + dt.timedelta(days = interval_days)):
            df6['book_end'][j] = (now + dt.timedelta(days = interval_days)).replace(hour=0, minute=0, second=0, microsecond=0)
        if d1 > (now + dt.timedelta(days = interval_days)):
            df6['book_start'][j] = (now + dt.timedelta(days = interval_days)).replace(hour=0, minute=0, second=0, microsecond=0)
            df6['book_end'][j] = (now + dt.timedelta(days = interval_days)).replace(hour=0, minute=0, second=0, microsecond=0)
    if len(df6) > 0:
        d0 = [df6.loc[0,'book_start'],df6.loc[0,'book_end']]
        dat01 = get_alldate(d0[0],d0[1]) 
        for j in range(1,len(df6)):
            d2 = [df6.loc[j,'book_start'],df6.loc[j,'book_end']]
            dat2 = get_alldate(d2[0],d2[1])
            uni = list(set(dat01)|set(dat2))
            if len(uni) == 0:
                dat01 = dat01 + dat2
            else:
                dat01 = uni
        dat01.sort()
        if dat01[0] > now:
            ava = (dat01[0]-now).days
        else:
            ava = 0
        if dat01[-1] < (now + dt.timedelta(days = interval_days)):
            dat01 = dat01 + [now + dt.timedelta(days = interval_days)]
        for j in range(1,len(dat01)):
            dat1 = dat01[j-1]
            dat2 = dat01[j]
            ava1 = (dat2-dat1).days
            if ava1 == 1:
                ava = ava + 0
            else:
                ava = ava + ava1
        return [ava,dat01, 1]
    else:
        return [interval_days,[(now + dt.timedelta(days=interval_days)).replace(hour=0, minute=0, second=0, microsecond=0)],0]

def get_date_ra(nid):
    ab = """select ab.nid, ab.book_start, ab.book_end
                from admin_book ab
                where ab.nid in ({0}) and ab.book_end >= curdate() order by ab.book_start""".format(nid)
    abt = """select abt.nid, abt.book_start, abt.book_end
                from admin_book_temp abt
                where abt.nid in ({0}) and abt.book_end >= curdate() order by abt.book_start""".format(nid)
    cur.execute(ab)
    colname = [str(i[0]) for i in cur.description]
    df = pd.DataFrame(columns=colname)
    val1 = cur.fetchall()
    cur.execute(abt)
    val2 = cur.fetchall()
    val = val1 + val2
    for i in range(len(val)):
        df.loc[i] = val[i]
    #df = df.sort("book_start")
    return df

def main():
    filename = "list_nid.csv"
    with open(filename) as f:
        reader = csv.DictReader(f)
        rows = list(reader)
        nid1 = [str(i["nid"]) for i in rows]
        nid2 = ",".join(nid1)
    data = get_data_db(nid2)
    
    interval = [30, 60, 90, 180, 365]
    coldf = ["nid","uid","calendar_status"]+["available_days_{0}".format(i) for i in interval]+["note"]
    folder = dt.datetime.now().strftime("%Y-%m-%d")
    if not os.path.exists(folder):
        os.mkdir(folder)
    csvname = os.path.join(folder,"availability_"+dt.datetime.now().strftime("T%H.%M")+".csv")
    alldat = []
    for i in range(0,len(data)):
        data1 = data[i]
        nid = data1['nid']
        dat = get_date_ra(nid)
        alldat.append(dat)
    alldat = pd.concat(alldat)
    df2 = []
    for i in range(0, len(data)):
        nid = data[i]['nid']
        uid1 = data[i]['uid']
        cal_sts = data[i]['cas']
        dat = alldat.loc[alldat['nid'] == nid]
        df3 = []
        for j in range(0,len(interval)):
            interval_days = interval[j]
            coldf1 = coldf[0:3] + ["available_days_{0}".format(interval_days)] + ["note"]
            df = pd.DataFrame(columns = coldf1)
            if len(dat) != 0:
                value = get_availability(dat, interval_days, nid)
                if value[-1] != 0:
                    df.loc[0] = [nid, uid1, cal_sts, value[0], ""]
                else:
                    df.loc[0] = [nid, uid1, cal_sts, value[0], "please check the calendar block"]
            else:
                df.loc[0] = [nid, uid1, cal_sts, value[0], "no calendar block on Database"]
            df3.append(df)
        df30 = df3[0]
        for j in range(1,len(df3)):
            df31 = pd.merge(df30,df3[j], how="outer", on=["nid","uid","calendar_status"])
            df30 = df31
        df2.append(df31)
    if len(df2) != 0:
        df21 = pd.concat(df2)
        df21 = df21[coldf]
        df21.fillna("").to_csv(csvname, index=False)
    
        #df = df.fillna("").to_csv(csvname, index=False)

if __name__ == '__main__':
    main()

    