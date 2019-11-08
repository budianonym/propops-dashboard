// const axios = require('axios');

// async function coba(){
// a = await axios.get('http://webcode.me')
// await console.log(a.data);

// }
// coba()

// const axios = require('axios');

// async function makeRequest() {

//     const config = {
//         method: 'get',
//         url: 'http://webcode.me'
//     }

//     let res = await axios(config)

//     console.log(res.status);
// }

// makeRequest();

const axios = require('axios');

async function getNumberOfFollowers() {
  
  let res = await axios.get('http://192.168.1.90:3000/');
// console.log(res)  
  let nOfFollowers = res.data.menu.id;
  // let location = res.data.location;

  console.log(`# of followers: ${nOfFollowers}`)
  // console.log(`Location: ${location}`)
}

getNumberOfFollowers();