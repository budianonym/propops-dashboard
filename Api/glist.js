
const {Builder, By, Key, until} = require('selenium-webdriver');

async function main() {
    let driver = await new Builder()
        .forBrowser('chrome')
        .build();

  await driver.get('http://www.google.com/ncr')
  
  const element = await driver.findElement(By.name('q'))
  
  await element.sendKeys('webdriver', Key.RETURN)
  // await driver.wait(until.titleIs('webdriver - Google Search'), 10000)
  await driver.findElement(By.xPath('/html/body/div[6]/div[3]/div[10]/div[1]/div[2]/div/div[2]/div[2]/div/div/div[1]/div/div/div/div[1]/a/h3/div')).click();
  //await driver.quit()
}
main()