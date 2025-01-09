const mysql = require('mysql');
//require('dotenv').config(); // Mengimpor dotenv untuk membaca konfigurasi dari file .env
require("dotenv").config();

// Membuat koneksi database
const {
    DB_HOST,      // Host database
    DB_USERNAME,      // Username database
    DB_PASSWORD,  // Password database
    DB_DATABASE,   // Nama database
} = process.env;

const db = mysql.createConnection({
    host: DB_HOST,
    user: DB_USERNAME,
    password: DB_PASSWORD,
    database: DB_DATABASE,
});

// Menghubungkan ke database
db.connect((err) => {
    if (err) {
        console.log("Error connecting to the database:" + err.stack);
        return;
    }else {
    console.log("Connected to the database");
    return;
    }
});

module.exports = db; // Ekspor koneksi untuk digunakan di file lain
