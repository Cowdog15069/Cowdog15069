// Assuming you have already set up your MySQL database and table

// Require necessary modules
const express = require('express');
const mysql = require('mysql');

// Create an Express app
const app = express();

// Create a MySQL connection pool
const pool = mysql.createPool({
    connectionLimit: 10,
    host: 'your_mysql_host',
    user: 'your_mysql_user',
    password: 'your_mysql_password',
    database: 'your_mysql_database'
});

// Handle registration
app.post('/register', (req, res) => {
    // Extract username and password from the request body
    const { username, password } = req.body;

    // Insert into the MySQL table
    pool.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], (error, results) => {
        if (error) {
            res.status(500).send('Error registering user');
        } else {
            res.status(200).send('User registered successfully');
        }
    });
});

// Handle login
app.post('/login', (req, res) => {
    // Extract email and password from the request body
    const { email, password } = req.body;

    // Check if email and password exist in the MySQL table
    pool.query('SELECT * FROM users WHERE email = ? AND password = ?', [email, password], (error, results) => {
        if (error) {
            res.status(500).send('Error logging in');
        } else {
            if (results.length > 0) {
                res.status(200).redirect('/index.html'); // Redirect to index.html if user exists
            } else {
                res.status(401).send('Email or password is incorrect'); // Unauthorized
            }
        }
    });
});

// Start the server
const port = 3000;
app.listen(port, () => {
    console.log(`Server is running on port ${port}`);
});
