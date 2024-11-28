const Web3 = require('web3');

// Conecta Web3 a Ganache
const web3 = new Web3('http://127.0.0.1:7545');  // Cambia si usas otro puerto

// Verifica si está conectado
web3.eth.net.isListening()
  .then(() => console.log('Conectado a Ganache'))
  .catch(e => console.log('No se pudo conectar a Ganache', e));
