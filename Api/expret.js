const express = require('express')
const app = express()
const port = 3000

app.use((req, res, next) => {
  res.append('Access-Control-Allow-Origin', ['*']);
  res.append('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
  res.append('Access-Control-Allow-Headers', 'Content-Type');
  next();
});

var mysql = require('mysql')
var connection = mysql.createConnection({
  host: 'radbw2a-cluster.cluster-ro-cqyy7fkqd6u0.us-west-2.rds.amazonaws.com',
  user: 'bhermawan',
  password: 'lTNM0d6CS3Eb%7(_',
  database: 'radb'
})

connection.connect()

connection.query(
    `SELECT * FROM node  
    where type = 'rental_property'
    order by nid
    desc
    LIMIT 200
    `
    , function (err, rows, fields) {
  if (err) throw err
  app.post('/', (req, res) => {
    return res.send(rows);
  });
  // console.log(rows)
})

connection.end()






app.get('/', (req, res) => {
  res.set('Content-Type', 'application/json')
  return res.send(
    {"menu": {
      "id": "file",
      "value": "File",
      "popup": {
        "menuitem": [
          {"value": "New", "onclick": "CreateNewDoc()"},
          {"value": "Open", "onclick": "OpenDoc()"},
          {"value": "Close", "onclick": "CloseDoc()"}
        ]
      }
    }}

  );
});

app.put('/', (req, res) => {
  return res.send('Received a PUT HTTP method');
});
app.delete('/', (req, res) => {
  return res.send('Received a DELETE HTTP method');
});

app.listen(port, () => console.log(`Example app listening on port ${port}!`))


// app.listen(port, () => console.log(`Example app listening on port ${port}!`))