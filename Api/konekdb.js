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
    LIMIT 10
    `
    , function (err, rows, fields) {
  if (err) throw err

  console.log(rows)
})

connection.end()