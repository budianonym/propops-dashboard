// Licensed to the Software Freedom Conservancy (SFC) under one
// or more contributor license agreements.  See the NOTICE file
// distributed with this work for additional information
// regarding copyright ownership.  The SFC licenses this file
// to you under the Apache License, Version 2.0 (the
// "License"); you may not use this file except in compliance
// with the License.  You may obtain a copy of the License at
//
//   http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing,
// software distributed under the License is distributed on an
// "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
// KIND, either express or implied.  See the License for the
// specific language governing permissions and limitations
// under the License.

/**
 * @fileoverview An example WebDriver script.
 *
 * Before running this script, ensure that Mozilla's geckodriver is present on
 * your system PATH: <https://github.com/mozilla/geckodriver/releases>
 *
 * Usage:
 *   // Default behavior
 *   node selenium-webdriver/example/google_search.js
 *
 *   // Target Chrome locally; the chromedriver must be on your PATH
 *   SELENIUM_BROWSER=chrome node selenium-webdriver/example/google_search.js
 *
 *   // Use a local copy of the standalone Selenium server
 *   SELENIUM_SERVER_JAR=/path/to/selenium-server-standalone.jar \
 *     node selenium-webdriver/example/google_search.js
 *
 *   // Target a remote Selenium server
 *   SELENIUM_REMOTE_URL=http://www.example.com:4444/wd/hub \
 *     node selenium-webdriver/example/google_search.js
 */

const {Builder, By, Key, until} = require('selenium-webdriver');
let nids = [4981,153]
let user = "budi.hermawan@redawning.com";
let pass = "changeme";

for(nid of nids){
var driver = new Builder()
    .forBrowser('chrome')
    .build();

function cek (param){
driver.findElement(By.id(param)).isSelected().then(function(selected){
     if (selected) {
        driver.findElement(By.id('a')).isSelected().then(function(result){
            console.log(result)
        })
        // console.log(driver.findElement(By.id('b')).click())}
}else{
            driver.findElement(By.id('b')).isSelected().then(function(result){
            console.log(result)
        })
}
})

};

function clickk(a){
driver.findElement(By.name(a)).isSelected().then(function(selected){
     if (selected) {
        driver.findElement(By.name(a)).click();
}
})
};

//edit-flag-has-tax



driver.get('https://admin.redawning.com/node/'+nid+'/price-edit')
.then(_ =>
         driver.findElement(By.name('name')).sendKeys('budi.hermawan@redawning.com'))
.then(_ =>
         driver.findElement(By.name('pass')).sendKeys('changeme', Key.RETURN))


// .then(_ =>
//          driver.findElement(By.xpath('//*[@id="rental-property-node-form"]/div/fieldset[6]/legend/span/a')).click())


// .then(_ =>
//          driver.findElement(By.id("edit-field-amenities-und-ice-maker")).click())

// .then(_ =>
//          driver.findElement(By.name('field_amenities[und][Bidet]')).click())
// .then(function(){
//     cek("field_amenities[und][Heater]");
// })
// .then(function(){
//     cek("field_amenities[und][Internet]");
// })
.then(_ =>
clickk ('flag_has_tax')
)

//fieldset-title
// .then(_ =>
//          driver.findElement(By.className("left rpbooknow btn btn-info pull-left")).click())

//btn btn-inverse close-btn
.then(_ =>
         driver.findElement(By.className("btn btn-inverse close-btn")).click())
.then(_ =>
         driver.findElement(By.id("defaultActionButton")).click())
.then(_ => driver.quit());

};


// .then(_ =>
// clickk ('field_amenities[und][ATM -- On Site]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Baby Crib]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Balcony]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Barbecue]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Bathtub]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Beach Access]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Beachfront]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Bidet]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Bike Storage]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Blender]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Boat Dock]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Breakfast]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Carbon Monoxide Detector]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Central Heating]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Chef]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Coffee Maker]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Daily Housekeeping]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Daily Housekeeping -- Free]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Deck/Patio]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Dining Area]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Dishwasher]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Dryer]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Electric Kettle]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Elevator]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Fan]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Fireplace]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Freezer]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Garage]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Garden]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Golf Course on Site]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Gym]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Hair Dryer]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Heater]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Hot Tub -- Private]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Hot Tub -- Shared]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Humidifier]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Ice Maker]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Internet]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Internet -- Wireless]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Ironing Board]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Jacuzzi Tub]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Kitchen Cookware and Utensils]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Lakefront]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Lanai]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Linens Provided]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Loft]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Microwave]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Mini-Bar]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Non Smoking]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Oceanfront]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Outdoor Fireplace]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Oven]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Parking]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Parking -- Covered]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Parking -- Free]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Parking -- Off Street]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Parking -- RV]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Pets OK]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Pool -- Heated]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Pool -- Indoor]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Pool -- Private]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Pool -- Shared]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Pool -- Unheated]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Private Entrance]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Refrigerator]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Safe]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Sauna]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Security Alarm]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Shampoo]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Shower]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Shuttle Service]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Ski Area]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Ski Cross Country]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Ski in/Ski out]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Ski Storage]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Smoke Detector]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Solarium]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Steam Room]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Steam Shower]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Telephone]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Tennis Court]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Terrace]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Toaster]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Toiletries Provided]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Walk-in Closet]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Washer/Dryer]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Washing Machine]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Waterfront]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Wood-Burning Fireplace]')
// )
// .then(_ =>
// clickk ('field_amenities[und][Wood-Burning Stove]')
// )
// .then(_ =>
// driver.findElement(By.id('edit-field-amenities-und-humidifier')).isSelected().then(function(selected){
//      if (!selected) {
//         driver.findElement(By.id('edit-field-amenities-und-humidifier')).click();
// }
// })
// )


// .then(_ =>
// driver.findElement(By.id('edit-field-amenities-und-internet')).isSelected().then(function(selected){
//      if (!selected) {
//         driver.findElement(By.id('edit-field-amenities-und-internet')).click();
// }
// })
// );

// driver.findElement(By.id('edit-field-amenities-und-ice-maker')).isSelected().then(selected =>
//      !selected ? driver.findElement(By.id('edit-field-amenities-und-ice-maker')).click())
// driver.findElement(By.id('edit-field-amenities-und-humidifier')).isSelected().then(selected =>
//      !selected ? driver.findElement(By.id('edit-field-amenities-und-humidifier')).click());
// driver.findElement(By.id('edit-field-amenities-und-interet')).isSelected().then(selected =>
//      !selected ? driver.findElement(By.id('edit-field-amenities-und-internet')).click());
// .then(clickk ("edit-field-amenities-und-ice-maker"))
// .then(clickk ("edit-field-amenities-und-bidet"))
// .then(clickk ("edit-field-amenities-und-internet"))
// .then(clickk ("edit-field-amenities-und-humidifier"))
// .then(function(){
//     if (driver.findElement(By.name('field_amenities[und][Ice Maker]')).isSelected()) {
//         // driver.findElement(By.name('name')).sendKeys(user)
//         driver.findElement(By.name('field_amenities[und][Ice Maker]')).click()
// } else {
//     // driver.findElement(By.name('name')).sendKeys("sdsdsdsdsdsds")
//     driver.findElement(By.name('field_amenities[und][Internet]')).click()
// }


    // }
    // );
// .then(_ =>
//         driver.findElement(By.name('pass')).sendKeys(pass, Key.RETURN))
// .then(function(){
//     if (driver.findElement(By.name('locked_config[2]')).isSelected()) {
//     console.log("selected");
// } else {
//     console.log("not selected");
// }
// });
// .then(_ => 
//         if (true) {
//         console.log("ssvsvsvs")
//     }
    
//         driver.findElement(By.name('q')).sendKeys("sdvsdvsdvs")


//         );
// driver.get('https://venomez.com/')
// .then(console.log("asasfsafas"));
// if (true) {
//         // console.log("ssvsvsvs");
    
//         driver.findElement(By.name('q')).sendKeys("sdvsdvsdvs");
//     }else {
// console.log("fal");
// };

    // .then(function(){
    //     console.log("title");
    // });
    // .then(_ => alert("sscscscsc"))
    // .then(_ =>
    //     driver.findElement(By.name('name')).sendKeys('budi.hermawan@redawning.com', Key.RETURN))
    // .then(_ =>
    //  function(){console.log("dsdvsdvsdvs")}
    //  );

//     .then(_ =>
// console.log('sdsdvsdvsdvsdv')
//         );

    // if (driver.findElement(By.name('locked_config[2]')).checked ){
    //     console.log("qqqqqqqqqqq");
    // } else {
    //     console.log("ladjhadgahgd");
    // }
    // );
   
    // if (document) {}


// .then(_ =>

//         driver.findElement(By.name('locked_config[1]')).click());

// if (driver.findElement(By.name('locked_config[2]').attribute("checked") ==false)) {
//     alert('tidak terclikc');
// }


    // document.getElementById("edit-locked-config-2").checked = true;

//     if ( !driver.findElement(By.id("edit-locked-config-2")).isSelected() )
// {
// 	.then(_ =>
//      driver.findElement(By.id("edit-locked-config-2")).click())
// };

    // .then(_ => driver.wait(until.titleIs('Edit Rental Property RA4981 | RedAwninggg'), 1000))
    // .then(_ => driver.quit());