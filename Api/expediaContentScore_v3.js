var fs = require('fs');
const jsonfile = require('jsonfile')
const file = 'cookie.json'
var records = [];
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
const port = 3000
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
                    //var qa = await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/div[2]/div')).getText()
// .catch((e) => {
//     if (e.name === 'NoSuchElementError') {
//         return 'NULL';
//     }
// })
// await driver.wait(until.elementLocated(By.xpath('//*[@id="content"]/div/div[2]/div[2]/div[2]')));
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

                    // else if (await driver.findElement(By.xpath('//*[@id="content"]/div/div[2]/div[2]/div[2]')).getText() == 'Sorry, something went wrong. Please try again.') {
                    //     await records.push({
                    //         id: `${nid}`,
                    //         overall: `Something went wrong`,
                    //         ame: `Something went wrong`,
                    //         room: `Something went wrong`,
                    //         poli: `Something went wrong`,
                    //         photos: `Something went wrong`
                    //     });
                    //     console.log(`ChannelID ${nid} Something went wrong...`)
                    //     continue
                    // }
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
app.listen(port, () => console.log(`Example app listening on port ${port}!`))