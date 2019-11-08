const { Builder, Session, By, Key, until } = require('./node_modules/selenium-webdriver/');
let chrome = require('selenium-webdriver/chrome');
const nids = [36839674, 36955196, 36978426, 35806826, 36068587];
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
const records = [];
async function propops() {
  var driver = await new Builder()
    .forBrowser('chrome')
    .setChromeOptions(new chrome.Options().headless())
    .build();

  driver.get('https://www.expediapartnercentral.com');
  console.log('Logging In...')
  await driver.findElement(By.name('username')).sendKeys('SYS_Redawning');
  await driver.findElement(By.name('password')).sendKeys('d!er:xXFAs62]5kD', Key.RETURN);
  console.log('Waiting For Expedia Verification Code...')
  await setTimeout(async function () {
    //SCRIPT FROM GMAILAPI=========================================================================
    const fs = require('fs');
    const readline = require('readline');
    const { google } = require('googleapis');

    // If modifying these scopes, delete token.json.
    const SCOPES = ['https://www.googleapis.com/auth/gmail.readonly'];
    // The file token.json stores the user's access and refresh tokens, and is
    // created automatically when the authorization flow completes for the first
    // time.
    const TOKEN_PATH = 'token.json';

    // Load client secrets from a local file.
    fs.readFile('credentials.json', (err, content) => {
      if (err) return console.log('Error loading client secret file:', err);
      // Authorize a client with credentials, then call the Gmail API.
      authorize(JSON.parse(content), listLabels);
    });

    /**
     * Create an OAuth2 client with the given credentials, and then execute the
     * given callback function.
     * @param {Object} credentials The authorization client credentials.
     * @param {function} callback The callback to call with the authorized client.
     */
    function authorize(credentials, callback) {
      const { client_secret, client_id, redirect_uris } = credentials.installed;
      const oAuth2Client = new google.auth.OAuth2(
        client_id, client_secret, redirect_uris[0]);

      // Check if we have previously stored a token.
      fs.readFile(TOKEN_PATH, (err, token) => {
        if (err) return getNewToken(oAuth2Client, callback);
        oAuth2Client.setCredentials(JSON.parse(token));
        callback(oAuth2Client);
      });
    }

    /**
     * Get and store new token after prompting for user authorization, and then
     * execute the given callback with the authorized OAuth2 client.
     * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
     * @param {getEventsCallback} callback The callback for the authorized client.
     */
    function getNewToken(oAuth2Client, callback) {
      const authUrl = oAuth2Client.generateAuthUrl({
        access_type: 'offline',
        scope: SCOPES,
      });
      console.log('Authorize this app by visiting this url:', authUrl);
      const rl = readline.createInterface({
        input: process.stdin,
        output: process.stdout,
      });
      rl.question('Enter the code from that page here: ', (code) => {
        rl.close();
        oAuth2Client.getToken(code, (err, token) => {
          if (err) return console.error('Error retrieving access token', err);
          oAuth2Client.setCredentials(token);
          // Store the token to disk for later program executions
          fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
            if (err) return console.error(err);
            console.log('Token stored to', TOKEN_PATH);
          });
          callback(oAuth2Client);
        });
      });
    }

    /**
     * Lists the labels in the user's account.
     *
     * @param {google.auth.OAuth2} auth An authorized OAuth2 client.
     */




    function listLabels(auth) {
      var gmail = google.gmail({ auth: auth, version: 'v1' });
      gmail.users.messages.list({
        userId: 'me',
        q: "from:airbnbphone@redawning.com label:no reply subject:Message is:unread 'Your Expedia verification code is: '",
      }, function (err, res) {
        if (err) {
          console.log('The Gmail API returned an error: ' + err);
          return;
        }
        var messageId = res.data.messages[0].id


        const gmail = google.gmail({ version: 'v1', auth });
        gmail.users.messages.get({
          'userId': 'budi.hermawan@redawning.com',
          'id': messageId
        }, (err, res) => {
          if (err) return console.log('The API returned an error: ' + err);
          var verifNumber = res.data.snippet.split('').reverse().join('').slice(0, 6).split('').reverse().join('')
          // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
          async function ccc(numnum) {
            await driver.findElement(By.name('verificationCode')).sendKeys(numnum, Key.RETURN);
            await driver.wait(until.titleIs('Manage a Property - Expedia PartnerCentral'), 9000);
            console.log(`Successfully Login...`);

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
            await csvWriter.writeRecords(records)
              .then(() => {
                console.log(`Script Done.`);
                console.log(`Open the CSV at ${theUrl}`);
              });

          }
          console.log(`Verification Code: ${verifNumber}`)
          ccc(verifNumber)
          // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ 
        });

      });
    }

    //ENDSCRIPT FROM GMAILAPI=========================================================================


  }, 10000);
}

propops()