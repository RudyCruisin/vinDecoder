require('dotenv').config()
const bodyParser = require('body-parser')
const express = require('express')
const app = express()

app.get('/testing'), (req, res) => {
    res.send("Testing")
}

app.listen(process.env.PORT, () => {
    console.log("server running on port: " + process.env.PORT)
})