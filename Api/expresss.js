const express = require('express')
const app = express()
const port = 4000
var bodyParser = require('body-parser')

app.use((req, res, next) => {
  res.append('Access-Control-Allow-Origin', ['*']);
  res.append('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
  res.append('Access-Control-Allow-Headers', 'Content-Type');
  next();
});
var jsonParser = bodyParser.text()
app.get('/', jsonParser,  (req, res) => {
    console.log(req.body.split(','))
return res.send(req.body)

  });

app.listen(port, () => console.log(`Example app listening on port ${port}!`))


// app.listen(port, () => console.log(`Example app listening on port ${port}!`))