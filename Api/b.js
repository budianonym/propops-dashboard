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

var driver = new Builder()
    .forBrowser('chrome')
    .build();

function cek (a){
        if (!driver.findElement(By.name(a)).isSelected()) {
        // driver.findElement(By.name('name')).sendKeys(user)
        driver.findElement(By.name(a)).click()
} else {
    console.log("scscs");
}
}

let user = "budi.hermawan@redawning.com";
let pass = "changeme";
let ss = driver.findElement(By.id('a'));
let bb = driver.findElement(By.id('b'));

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

function clickk (param){
driver.findElement(By.id(param)).isSelected().then(function(selected){
     if (!selected) {
        driver.findElement(By.id(param)).click();
}
})
};


driver.get('http://localhost/test.php')
.then(_ =>
         driver.findElement(By.id('aa')).sendKeys(user))
.then(_ =>
         driver.findElement(By.xpath('//*[@id="exampleFormControlSelect1"]/option[4]')).click())
.then(_ =>
         driver.findElement(By.xpath('//*[@id="exampleFormControlSelect2"]/option[5]')).click())
.then(_ =>
         driver.findElement(By.id('asd')).click())

//*[@id="exampleFormControlSelect1"]/option[3]
// .then(function(){
//         driver.findElement(By.id('a')).isSelected().then(function(result){
//             console.log(result)
//         })
//     }
//         );

.then(cek ("a"))
.then(cek ("b"))
.then(clickk ("a"))
.then(clickk ("b"))