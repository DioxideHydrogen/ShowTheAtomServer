const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const port = 3000;
const mysql = require('mysql');

function execSQLQuery(sqlQry, res){
	const connection = mysql.createConnection({
	host: 'localhost',
	port: 3306,
	user: 'root',
	password: '',
	database: 'sta'

});
	connection.query(sqlQry, function(error, results, fields){
		if(error)
			res.json(error);
		else
			res.json(results);
		connection.end();
		console.log('Connected to Database and Returning Results!')
	})
}
//cofigurando body parser para pegar os POSTS mais tarde
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());

//definindo as rotas
const router = express.Router();
router.get('/',(req,res) => res.json({message: 'HTTP Request 200 OK!'}));
app.use('/',router);

router.get('/atoms',(req, res) =>{
	execSQLQuery('SELECT * FROM elements', res);
});

router.get('/atom/:id?', (req, res) =>{
	let filter = '';
	if(req.params.id) filter = ' WHERE numatom=' + parseInt(req.params.id);
	execSQLQuery("SELECT * FROM elements"+filter, res);
});

router.delete('/atom/:id', (req,res) =>{
	execSQLQuery('DELETE FROM elements WHERE id=' + parseInt(req.params.id), res);
});

router.post('/atom', (req,res) =>{
	const id = req.body.id.substring(0,200);
	const element = req.body.element.substring(0,150);
	const numatom = req.body.numatom.substring(0,150);
	const description = req.body.description.substring(0,7500);
	execSQLQuery(`INSERT INTO elements(id, element, numatom, description) VALUES('${id}','${element}','${numatom}','${description}')`, res);
});

router.patch('/atom/:id', (req,res) =>{
	const id = parseInt(req.params.id);
	const element = req.body.element.substring(0,150);
	const numatom = req.body.numatom.substring(0,150);
	const description = req.body.description.substring(0,7500);
	execSQLQuery(`UPDATE elements SET element='${element}', numatom='${numatom}', description='${description}' WHERE id='${id}'`, res);
});
//inicia o servidor
app.listen(port)
console.log('API Working!')