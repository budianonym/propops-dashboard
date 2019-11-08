const {Builder, By, Key, until} = require('selenium-webdriver');
let nids = [152, 153]
let user = "budi.hermawan@redawning.com";
let pass = "changeme";
let i = 0;

function clickk(a){
driver.findElement(By.name(a)).isSelected().then(function(selected){
     if (selected) {
        driver.findElement(By.name(a)).click();
}
})
};

async function mainn(){
var driver = await new Builder()
    .forBrowser('chrome')
    .build();

driver.get('https://admin.redawning.com/node/4981/price-edit');
await driver.findElement(By.name('name')).sendKeys('budi.hermawan@redawning.com');
await driver.findElement(By.name('pass')).sendKeys('changeme', Key.RETURN);
// await driver.findElement(By.className("btn btn-inverse close-btn")).click();
await driver.findElement(By.xpath('//*[@id="controlPanel"]/div[1]/div[2]/button')).click();
//*[@id="controlPanel"]/div[1]/div[2]/button

for (nid of nids){
await driver.get('https://admin.redawning.com/node/'+nid+'/price-edit');
await driver.findElement(By.name('flag_has_tax')).click();
await driver.findElement(By.id("defaultActionButton")).click();
};
await driver.quit();
};

mainn();
