const express = require("express");
const mysql = require("mysql");
const session = require("express-session");
const app = express();
const bodyparser=require("body-parser");

const conn = mysql.createConnection({
    host: 'localhost',
    port: '3307',
    database: 'timetablegen',
    user: 'root',
    password: ''
});


app.use(session({
    secret: 'secret',
    resave: true,
    saveUninitialized: true
}));

app.use(express.static(__dirname + "/public"));
app.use(express.urlencoded({ extended: false }));
app.use(express.json());
app.set('view engine', 'ejs');



app.get('/', function(req, res) {
    res.sendFile(__dirname + '/public' + '/home.html');
    req.session.destroy();
});

app.get('/home', function(req, res) {
    res.sendFile(__dirname + '/public' + '/home.html');
    req.session.destroy();
});


app.get('/coordinate', function(req, res) {
    res.sendFile(__dirname + '/public' + '/coordinate.html');
    req.session.destroy();
});


app.post('/coordinate', (req, res) => {
    const username = req.body.username;
    const password = req.body.password;
    
    conn.query('SELECT * FROM coordinator WHERE username = ? AND password = ?', [username, password], (error, results) => {
        if (results.length === 0) {
          return res.status(401).json({ message: 'Invalid username or password' });
        }
        req.session.username=username;
        if(req.session.username){
            res.sendFile(__dirname+'/public'+'/cdashboard.html');
        }
        else{
            res.sendFile(__dirname+'/public'+'/coordinate.html');
        }
    });
});


app.post('/cdashboard',(req,res)=>{
    const { year, section, day } = req.body;
    for (let i = 1; i <= 8; i++) {
        const hour = req.body[`hour${i}`];
        const subjectName = req.body[`subjectname${i}`];
        const facultyName = req.body[`facultyname${i}`];

        conn.query('SELECT * FROM timetable where year=? and section=? and day=? and hour=?',[year,section,day,hour],(error,results)=>{
            if (results.length > 0)
            {
                conn.query('DELETE FROM timetable WHERE year=? and section=? and day=? AND hour=?',[year,section,day,hour],(error,results)=>{});
            }
            conn.query('INSERT INTO timetable(year, section, day, hour, subject, faculty) VALUES (?,?,?,?,?,?)',[year,section,day,hour,subjectName,facultyName],(error,results)=>{});
            conn.query('DELETE FROM timetable WHERE hour=? or subject=? or faculty=?',['','',''],(error,results)=>{});
        });

    }
    res.sendFile(__dirname+'/public'+'/cdashboard.html');
});


app.get('/admin', function(req, res) {
    res.sendFile(__dirname + '/public' + '/admin.html');
    req.session.destroy();
});

app.post('/admin',(req,res)=>{
    const ausername=req.body.username;
    const apassword=req.body.password;

    conn.query('select * from admin where username=? and password=?',[ausername,apassword],(error,results)=>{
        if (results.length === 0) {
            return res.status(401).json({ message: 'Invalid username or password' });
        }
        req.session.ausername=ausername;
        if(req.session.ausername){
            res.sendFile(__dirname+'/public'+'/adashboard.html');
        }
        else{
            res.sendFile(__dirname+'/public'+'/admin.html');
        }
    });
});

app.post('/adashboard',(req,res)=>{
    const ayear=req.body.year;
    const asection=req.body.section;
    conn.query('SELECT * FROM timetable where year=? and section=?',[ayear,asection],(error,results,fields)=>{
        if(error) throw error;
        res.render(__dirname+'/views'+'/atimetable',{results:results});
    })
});


app.get('/aregister',(req,res)=>{
    res.sendFile(__dirname+'/public'+'aregister.html');
});


app.post('/aregister',(req,res)=>{
    const aname=req.body.name;
    const ausername=req.body.username;
    const apassword=req.body.password;
    const adob=req.body.dob;

    conn.query('INSERT INTO admin(name,username,password,dob) values (?,?,?,?)',[aname,ausername,apassword,adob],(error,results)=>{});
    res.sendFile(__dirname + '/public' + '/admin.html');
});


app.get('/faculty',(req,res)=>{
    res.sendFile(__dirname+'/public'+'/faculty.html');
});

app.get('/fregister',(req,res)=>{
    res.sendFile(__dirname+'/public'+'/fregister.html');
});

app.post('/fregister',(req,res)=>{
    const fname=req.body.fname;
    const fusername=req.body.fusername;
    const fpassword=req.body.fpassword;
    const fdob=req.body.fdob;

    conn.query('INSERT INTO faculty(name,username,password,dob) values (?,?,?,?)',[fname,fusername,fpassword,fdob],(error,results)=>{});
    res.sendFile(__dirname + '/public' + '/faculty.html');
});


app.use(express.urlencoded({ extended: false }));


app.post('/faculty',(req,res)=>{
    const fusername=req.body.fusername;
    const fpassword=req.body.fpassword;
    conn.query('select * from faculty where username=? and password=?',[fusername,fpassword],(error,results)=>{
        if (results.length === 0) {
            return res.status(401).json({ message: 'Invalid username or password' });
        }
        req.session.fusername=fusername;
        if(req.session.fusername){
            res.sendFile(__dirname+'/public'+'/fdashboard.html');
        }
        else{
            res.sendFile(__dirname+'/public'+'/faculty.html');
        }
    });
});
app.use(bodyparser.json());


app.post('/action1',(req,res)=>{
    const fusername=req.session.fusername;
    conn.query('SELECT * FROM timetable WHERE faculty=(SELECT name FROM faculty WHERE username=?)',[fusername],(error,results)=>{
        res.render(__dirname+'/views'+'/ftimetable',{results:results});
    });
});


app.listen(3000, () => {
    console.log("Server is running on port 3000");
});
