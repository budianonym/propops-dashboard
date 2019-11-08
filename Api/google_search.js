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

// const {Builder, By, Key, until} = require('..');

// var driver = await new Builder()
//     .forBrowser('firefox')
//     .build();

// driver.get('http://www.google.com/ncr')
//     .then(_ =>
//         driver.findElement(By.name('q')).sendKeys('venoweb', Key.RETURN))
//     .then(_ => driver.wait(until.titleIs('venoweb - Google Search'), 1000))
//     .then(_ => driver.get('http://www.venoweb.com/'))
//     // .then(_ => driver.quit())

// clienID
// 119322412162-dpif8t70ef7buhi5vmnsbsrldobn13i6.apps.googleusercontent.com
// clientsecret
// XgnSUY46kxmwQghnx17GkpD-



const { Builder, Session, By, Key, until } = require('./node_modules/selenium-webdriver/');
async function coba() {
    var driver = new Builder()
        .forBrowser('chrome')
        .build();
    var session = new Session()


    console.log(session)
    driver.get('https://google.com')
    // driver.get('https://redawning.okta.com/app/UserHome')
    // await driver.findElement(By.name('username')).sendKeys('budi.hermawan@redawning.com')
    // await driver.findElement(By.name('password')).sendKeys('Backboners1~', Key.RETURN)
    await driver.findElement(By.name('q')).sendKeys('venoweb')
    await driver.wait(until.titleIs('venoweb - Google Search'), 1000)




    await driver.get('http://www.venoweb.com/')
    // await driver.quit()
}
coba();
;
