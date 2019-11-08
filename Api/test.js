const {Builder, Session, By, Key, until} = require('./node_modules/selenium-webdriver/');
let chrome = require('selenium-webdriver/chrome');

function encode(file) {
    var stream = require('fs').readFileSync(file);
    return new Buffer.from(stream).toString('base64');
}

async function coba(){
var driver = new Builder()
    .forBrowser('chrome')
    .setChromeOptions(new chrome.Options().addExtensions(encode('/home/mindo-pc18/Downloads/Okta-Browser-Plugin.crx')).setChromeLogFile( '~/.config/google-chrome' ))
    .build();


    // driver.get('https://google.com')    
driver.get('https://redawning.okta.com/app/UserHome')
//*[@id="main-content"]/div/div[2]/ul[2]/li[1]/a
// var a = await driver.findElement(By.xpath('//*[@id="fsl"]/a[2]')).getText()

await driver.findElement(By.name('username')).sendKeys('budi.hermawan@redawning.com')
await driver.findElement(By.name('password')).sendKeys('Backboners1~', Key.RETURN)
await driver.wait(until.elementLocated(By.xpath('//*[@id="form8"]/div[2]/input')))
await driver.findElement(By.xpath('//*[@id="form8"]/div[2]/input')).click()
await driver.wait(until.elementLocated(By.xpath('//*[@id="main-content"]/div/div[2]/ul[2]/li[1]/a')))
await driver.findElement(By.xpath('//*[@id="main-content"]/div/div[2]/ul[2]/li[1]/a')).click()
// await driver.findElement(By.name('q')).sendKeys('venoweb')
// await driver.wait(until.titleIs('venoweb - Google Search'), 1000)
// await driver.get('http://www.venoweb.com/')
console.log(a)
// await driver.quit()
}
coba();