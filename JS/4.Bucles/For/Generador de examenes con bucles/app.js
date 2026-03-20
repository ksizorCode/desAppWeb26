
//DATOS

const preguntas = [
  ["¿Cuál es la capital de España?", ["Madrid", "Oviedo", "Barcelona", "Paris", "Gijón", "Avilés"], 1],
  ["¿Cuál es la capital de Francia?", ["Madrid", "Oviedo", "Barcelona", "Paris"], 4],
  ["¿Donde está el Coliseo?", ["Madrid", "Roma"], 2],
  ["¿Cuál es la capital de Portugal?", ["Madrid", "Oviedo", "Lisboa", "Paris"], 3],
  ["¿Donde murió Hitler?", ["Madrid", "Oviedo", "Barcelona", "Berlin"], 4],
  ["¿Quién pintó la Mona Lisa?", ["Vincent van Gogh", "Pablo Picasso", "Leonardo da Vinci", "Salvador Dalí"], 3],
  ["¿Qué continente es el más grande en superficie?", ["África", "Asia", "América", "Europa"], 2],
  ["¿En qué año se llegó por primera vez a la luna?", ["1965", "1969", "1972", "1980"], 2],
  ["¿Quién escribió 'Cien años de soledad'?", ["Mario Vargas Llosa", "Julio Cortázar", "Gabriel García Márquez", "Pablo Neruda"], 3],
  // Historia del Arte
  ["¿Qué gas es más abundante en la atmósfera terrestre?", ["Oxígeno", "Nitrógeno", "Dióxido de carbono", "Helio"], 2],
  ["¿En qué país se originó el sushi?", ["Corea", "Japón", "China", "Tailandia"], 2],
  ["¿Cuál es el océano más grande?", ["Atlántico", "Índico", "Ártico", "Pacífico"], 4],
  ["¿Qué filósofo es conocido por la frase 'Pienso, luego existo'?", ["Aristóteles", "Sócrates", "René Descartes", "Friedrich Nietzsche"], 3],
  ["¿Qué ciudad es conocida como 'La Ciudad Eterna'?", ["Roma", "Atenas", "París", "Londres"], 1],
  ["¿Quién fue el primer presidente de los Estados Unidos?", ["Thomas Jefferson", "George Washington", "Abraham Lincoln", "John Adams"], 2]

];

let numpreguntas = 14;
//DIBUJAR PREGUNTAS
let libreta = "<ol>";
for (i = 0; i < numpreguntas; i++) {
  libreta += "<li>";
  libreta += preguntas[i][0];
  libreta += "<ul>";
  
  for (j = 0; j < preguntas[i][1].length; j++) {
    libreta += `<li>
                <label>
                <input type="radio" name="r${[i]}">
                ${preguntas[i][1][j]}</label>
                </li>`;
      }

    libreta += "</ul>";
  libreta += "</li>";

}
libreta += "</ol>";

document.querySelector("#examen").innerHTML = libreta;
document.querySelector('#mostrarCodigo').innerText=libreta;