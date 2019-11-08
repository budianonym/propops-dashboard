var fs = require('fs');
const jsonfile = require('jsonfile')
const file = 'cookie.json'
var records = [];
var facilities = [];
const { Builder, Session, By, Key, until } = require('selenium-webdriver');
let chrome = require('selenium-webdriver/chrome');
// const nids = [36839674,36980016,36806944,36806883,36806906];
const createCsvWriter = require('csv-writer').createObjectCsvWriter;
const theNow = Math.floor(Date.now() / 1000);
const theUrl = `/home/mindo-pc18/Code/nodejs/score-${theNow}.csv`;
const csvWriter = createCsvWriter({
    path: theUrl,
    header: [
        { id: 'id', title: 'Channel ID' },
        { id: 'overall', title: 'Overall' },
        { id: 'ame', title: 'Property amenities' },
        { id: 'room', title: 'Room amenities' },
        { id: 'poli', title: 'Policies and deposits' },
        { id: 'photos', title: 'Photos' },
    ]
})

var express = require('express')
var app = express()
const port = 3333
var bodyParser = require('body-parser')
app.use((req, res, next) => {

    res.append('Access-Control-Allow-Origin', ['*']);
    res.append('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
    res.append('Access-Control-Allow-Headers', 'Content-Type');
    res.header('Cache-Control', 'private, no-cache, no-store, must-revalidate');
    res.header('Expires', '-1');
    res.header('Pragma', 'no-cache');
    next();
});
// var jsonParser = bodyParser.text()
var jsonParser = bodyParser.json()

app.post('/expedia/score', jsonParser, function (req, res) {
    // var nids = req.body.split(',')
    // console.log(req.body)
    var nids = req.body.data.channelid.split(',')
    var dataCookie = req.body.data.cookie
    console.log(nids)
    // res.end()


    // ===================================
    //Starting Webdriver
    var driver = new Builder()
        .forBrowser('chrome')
        .setChromeOptions(new chrome.Options().headless())
        .build();

    driver.get('http://example.com/')
        //Injecting Cookie in Chromedriver
        // .then(() => {
        //     jsonfile.readFile(file, function (err, obj) {
        //         if (err) console.error(err)
        //         for (i in obj)
        //             driver.manage().addCookie({
        //                 name: obj[i].name,
        //                 value: obj[i].value,
        //                 domain: obj[i].domain,
        //                 path: obj[i].path
        //             })
        //     })

        // })
        .then(() => {
                for (i in dataCookie)
                    driver.manage().addCookie({
                        name: dataCookie[i].name,
                        value: dataCookie[i].value,
                        domain: dataCookie[i].domain,
                        path: dataCookie[i].path
                    })

        })


        .then(() => setTimeout(function () {
            driver.get('https://apps.expediapartnercentral.com/manageproperty/ManageProperty')
                .then(() => {
                    console.log('Successfully enter EPC Dashboard...')
                    console.log('Grabbing Content Score...')
                })


            async function contentScore() {
                //Starting Looping
                for (nid of nids) {
                    await driver.get('https://apps.expediapartnercentral.com/lodging/content/summary.html?htid=' + nid + '#/');
                    //Checking existance of Channel ID in EPC
                    if (await driver.getCurrentUrl() == 'https://apps.expediapartnercentral.com/static/lodging/Unauthorized.html#/') {
                        await records.push({
                            id: `${nid}`,
                            overall: `Can't be Accessed`,
                            ame: `Can't be Accessed`,
                            room: `Can't be Accessed`,
                            poli: `Can't be Accessed`,
                            photos: `Can't be Accessed`
                        });
                        console.log(`ChannelID ${nid} Doesn't Exist...`)
                        continue
                    }
                    //Grabbing Content Score
                    await driver.wait(until.elementLocated(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/header/div/h3/span')));
                    await driver.wait(until.elementLocated(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[1]/div/div[2]/div')));

                    var score = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/header/div/h3/span')).getText();
                    var all = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/header/div/h3')).getText()
                        .then(aa => aa.replace(/(\r\n|\n|\r)/gm, ''))
                        .then(qq => qq.replace(score, ''))
                        .then(qq => qq.replace('Level: ', ''));

                    var ame = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[1]/div/div[1]/span')).getText()
                        .then(qq => qq.replace('Level: ', ''))
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;
                    var ameScore = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[1]/div/div[2]/div')).getText()
                        .then(qq => qq)
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;

                    var room = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[2]/div/div[1]/span')).getText()
                        .then(qq => qq.replace('Level: ', ''))
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;
                    var roomScore = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[2]/div/div[2]/div')).getText()
                        .then(qq => qq)
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;

                    var policy = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[3]/div/div[1]/span')).getText()
                        .then(qq => qq.replace('Level: ', ''))
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;
                    var policyScore = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[3]/div/div[2]/div')).getText()
                        .then(qq => qq)
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;

                    var photos = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[4]/div/div[1]/span')).getText()
                        .then(qq => qq.replace('Level: ', ''))
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;

                    var photosScore = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/section/article[4]/div/div[2]/div')).getText()
                        .then(qq => qq)
                        .catch((e) => {
                            if (e.name === 'NoSuchElementError') {
                                return 'NULL';
                            }
                        })
                        ;
                    //Pushing result into variable record
                    await records.push({
                        id: `${nid}`,
                        overall: `${all}(${score})`,
                        ame: `${ame}(${ameScore})`,
                        room: `${room}(${roomScore})`,
                        poli: `${policy}(${policyScore})`,
                        photos: `${photos}(${photosScore})`
                    });
                    console.log(`ChannelID ${nid} Success...`)
                    // console.log(`${nid} : Overall -> ${all}(${score}) | Property amenities -> ${ame}(${ameScore}) | Room amenities -> ${room}(${roomScore}) | Policies and deposits -> ${policy}(${policyScore}) | Photos -> ${photos}(${photosScore})`);

                };
                await driver.quit();
                //Creating CSV File of variable records
                // await csvWriter.writeRecords(records)
                //     .then(() => {
                //         console.log(`Done`);
                //         console.log(`Open the CSV at ${theUrl}`);
                //     });

            }
            contentScore()
                .then(() => {
                    // console.log(records);
                    console.log(`Done`);
                    return res.send(records);

                })
                .then(() => {
                    records = []
                })
        }, 5000))


    // ===================================
})



app.post('/ra/facilityname', jsonParser, function (req, res) {

    var nidss = req.body.data.channelid
    var dataCookiee = req.body.data.cookie
    console.log('Starting..')



        var driver =  new Builder()
        .forBrowser('chrome')
        // .setChromeOptions(new chrome.Options().headless())
        .build();
    
        driver.get('http://example.com/')
        .then(() => {
            for (i in dataCookiee)
                driver.manage().addCookie({
                    name: dataCookiee[i].name,
                    value: dataCookiee[i].value,
                    domain: dataCookiee[i].domain,
                    path: dataCookiee[i].path
                })

    })
    
        .then(()=> setTimeout(function(){
    
            async function gg(){
    // setTimeout(function(){
        // await driver.get(`https://admin.redawning.com/admin/config-redawning/facility-name-conversion?filter[filter_ext_name]=tv%20options%20-%20directv%20with%20premium%20channels%2C%20nfl%20sunday%20ticket%20%26%20blu-ray/dvd%20player&filter[limit]=500`)
                for (i in nidss){
    
                    await driver.get(`https://admin.redawning.com/admin/config-redawning/facility-name-conversion?filter[filter_ext_name]=${nidss[i].ext_name.replace('&', '%26').replace('+','%2B').replace('=','%3D').replace(':','%3A').replace(`'`,'%27').replace(' ','%20')}&filter[filter_facility_name]=${nidss[i].facility_name}&filter[filter_type]=${nidss[i].type}&filter[limit]=800`)
                    
                    // await driver.executeScript(`document.getElementById("bulk_action").value = 'edit_selected';`)
                    await driver.findElement(By.name(`facility_name_table_view[${nidss[i].id}]`)).click()
     
                    await driver.findElement(By.id('bulk_action')).sendKeys('e')
                    await driver.wait(until.elementLocated(By.xpath('//*[@id="edit-action-facility-type"]')))
                    // await driver.executeScript(`document.querySelector("#wrap-facility-type > div").style.display = 'block';`)
                    await driver.findElement(By.id('edit-action-facility-type')).click()
                    await driver.findElement(By.id('edit-action-facility-type')).sendKeys(nidss[i].type_target, Key.RETURN)
                    // await driver.sleep(1000)
                    // await driver.executeScript(`document.querySelector("#edit-action-facility-type").value = '${nidss[i].type}';`)
                    // await driver.sleep(1000)
                    
                    await driver.wait(until.elementLocated(By.xpath('//*[@id="edit-edit-facility-name--2"]/option[2]')))
                    //await driver.sleep(2000)
                    await driver.findElement(By.name('edit_facility_name')).click()
                    await driver.findElement(By.name('edit_facility_name')).sendKeys(nidss[i].facility_name_target, Key.RETURN)
                    
                    // await driver.executeScript(`document.querySelector("#edit-edit-facility-name--2").value = '${nidss[i].facility_name}';`)
                    await driver.findElement(By.id('edit-apply')).click()
                    await driver.switchTo().alert().accept()
                    await driver.sleep(1000)
                    await facilities.push({
                        id: `${nidss[i].id}`,
                        name: `${nidss[i].ext_name}`,
                        type: `${nidss[i].type_target}`,
                        facilities: `${nidss[i].facility_name_target}`,
                        status: `Success`,
                    });
                    console.log(`${nidss[i].id} -> ${nidss[i].facility_name_target}`)
                    
                }
    

            }
            gg()
            .then(() => {
                driver.quit();

            })            
            
            .then(() => {
                // console.log(records);
                //console.log(facilities);
                return res.send(facilities);
                console.log('Done..')
            })
            .then(() => {
                // console.log(records);
                facilities = [];
            })
    
    
    
        }, 2000))


    })
app.listen(port, () => console.log(`Example app listening on port ${port}!`))