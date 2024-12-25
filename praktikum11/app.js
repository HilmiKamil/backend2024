const express = require("express");
const router = require("./routes/api.js"); 
const app = express()

app.use(express.json());
app.use(express.urlencoded());

app.use(router);

app.listen(3000, ()=>{
    console.log("Server running at http://localhost:3000");
});


