# -*- coding: utf-8 -*-
import requests

def sitAtual():
    r = requests.get('http://e9c0adf2.ngrok.io/atoms')
    print r.json()

def insert(id, name, numatom, description):
    descricao = open(description)
    descricao = descricao.read()
    r = requests.post('http://e9c0adf2.ngrok.io/atom', data={'id': id,'element': name, 'numatom': numatom, 'description': descricao})
    print r.status_code
    print r.text
def delete(id):
    link = 'http://e9c0adf2.ngrok.io/atom/' + id
    r = requests.delete(link)
    print r.status_code
    print r.text
def atualizar(id, name, numatom, description):
    descricao = open(description)
    descricao = descricao.read()[:-1]
    r = requests.patch('http://e9c0adf2.ngrok.io/atom/'+str(id), data={'id': id ,'element': name, 'numatom': numatom, 'description': descricao})
    print r.status_code
    print r.text
def main():
    print '''
    Professor James Bath and ShowTheAtom
    MySQL Insertion of Data by requests
    Python 2.7
    [0] Situação Atual
    [1] Inserir dados
    [2] Deletar dados // Informar caso utilize essa função
    [3] Atualizar dados
    '''

    choice = int(raw_input('>: '))
    if choice == 0:
        sitAtual()
    if choice == 1:
        id = raw_input("ID: ")
        name = raw_input("Nome do átomo: ")
        numatom = int(raw_input("Número atómico: "))
        description = raw_input("Nome de arquivo contendo a descrição do átomo: ")
        insert(id, name, numatom, description)
    if choice == 2:
        id = raw_input("ID do átomo que deseja deletar: ")
        delete(id)
    if choice == 3:
        id = int(raw_input("ID do átomo que deseja alterar dados: "))
        name = raw_input("Nome novo do átomo: ")
        numatom = int(raw_input("Número atómico novo : "))
        description = raw_input("Nome de arquivo contendo a nova descrição do átomo: ")
        atualizar(id,name, numatom, description)

main()