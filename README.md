# <center style="text-decoration: underline;">Show The Atom Server</center>

##   <center>Tecnologia desenvolvida com:</center>
![NodeJS](https://img.shields.io/badge/NodeJS-v10.15.3-brightgreen.svg)  

![MariaDB](https://img.shields.io/badge/MariaDB-v10.1.37-blue.svg)   

![Python2.7](https://img.shields.io/badge/Python-v2.7-yellow.svg)

- **index.js**:
	- **Configurações do host**:
		```
		const express = require('express');
		const app = express();
		const bodyParser = require('body-parser');
		const port = 3000;
		const mysql = require('mysql');
		//cofigurando body parser para pegar os POSTS mais tarde
		app.use(bodyParser.urlencoded({extended: true}));
		app.use(bodyParser.json());
		```
	- Função **execSQLQuery**:
		````
		function execSQLQuery(sqlQry, res){
		    const connection = mysql.createConnection({
	                host: 'localhost', 
	                port: 3306,
	                user: 'root',
	                password: '',
	                database: 'sta'
			});
		   connection.query(sqlQry, function(error, results, fields){
	           if(erro) 
	               res.json(error);
	           else
	               res.json(results);
		   connection.end();
		   console.log('Connected to Database and Returning Results!')
			})
		}

	- Para requisições get na url principal, esperamos uma resposta em formato **JSON**:
	```
	{
  "message": "HTTP Request 200 OK!"
	}
	```
	Já que o código para a requisição é:
	```
	const router = express.Router();
	router.get('/',(req,res) => res.json({message: 'HTTP Request 200 OK!'}));
	app.use('/',router);
	```
	 - Para requisições get na url **/atoms**, esperamos o retorno de todos os dados da database, com o **id**, **element**, **numatom**, **description** de cada **átomo**, como segue o código e o exemplo, respectivamente:
	
		```
		router.get('/atoms',(req, res) =>{
		    execSQLQuery('SELECT * FROM elements', res);
		});
		```
		
	```
	{
    "id": 1,
    "element": "Hydrogen",
    "numatom": 1,
    "description": "Hydrogen is a chemical element with symbol H and atomic number 1. With a standard atomic weight of 1.008, hydrogen is the lightest element in the periodic table. Hydrogen is the most abundant chemical substance in the Universe, constituting roughly 75% of all baryonic mass.Non-remnant stars are mainly composed of hydrogen in the plasma state. The most common isotope of hydrogen, termed protium (name rarely used, symbol 1H), has one proton and no neutrons."
  }
	```
	- Para requisições get na url **/atom/*id*** esperamos o **retorno de dados** de um **determinado átomo**, lembrando que o **id equivale ao número atômico** do átomo, segue código:
	```
	router.get('/atom/:id?', (req, res) =>{
	    let filter = '';
	    if(req.params.id) filter = ' WHERE numatom=' + parseInt(req.params.id);
	    execSQLQuery("SELECT * FROM elements"+filter, res);
	});
	```
    - Para requisições delete na url **/atom/*id*** esperamos a **exclusão** de um determinado dado, segue código:
	   ```
		router.delete('/atom/:id', (req,res) =>{
		    execSQLQuery('DELETE FROM elements WHERE id=' + parseInt(req.params.id), res);
		});
	- Para requisições post na url **/atom** esperamos a **inserção de dados** no banco de dados, segue código:
		```
		router.post('/atom', (req,res) =>{
		    const id = req.body.id.substring(0,200);
		    const element = req.body.element.substring(0,150);
		    const numatom = req.body.numatom.substring(0,150);
		    const description = req.body.description.substring(0,7500);
		    execSQLQuery(`INSERT INTO elements(id, element, numatom, description) VALUES('${id}','${element}','${numatom}','${description}')`, res);
		});
		```
	- Para requisições patch na url **/atom/*id*** esperamos que as **informações** sobre um **específico átomo** seja **atualizadas**, segue código:
		```
		router.patch('/atom/:id', (req,res) =>{
		    const id = parseInt(req.params.id);
		    const element = req.body.element.substring(0,150);
		    const numatom = req.body.numatom.substring(0,150);
	        const description = req.body.description.substring(0,7500);
	        execSQLQuery(`UPDATE elements SET element='${element}', numatom='${numatom}', description='${description}' WHERE id='${id}'`, res);
		});
		```
