<style>
    body {
        max-width: 960px;
        margin: 20px auto;
        font-family: sans-serif;
        padding: 20px;
    }
    code{
        padding: 5px;
        background:#DEDEDE;
        border-radius: 3px;
        font-weight: bold;
        transition:.7   s;
        display: inline-block;
    }
    code:hover{
        scale:3;
    }
    .ori{ background-color: yellow;}
    .enc{ background-color: violet;}
    .des{ background-color: greenyellow;}

/* Table */
    td:nth-child(odd), th:nth-child(odd) {
  background-color: #8c8c8c;}

  td{
    padding:10px
  }
}
</style>

<h1>Encriptaciónes en PHP</h1>

<form>
    <input type="text" value="Hola Mundo" name="texto" placeholder="Inserta el texto a encriptar">
    <input type="submit" value="Encriptar">
</form>


<?
if (isset($_GET['texto'])) {
    $texto = $_GET['texto'];
} else {
    $texto = "Hola Mundo";
}
?>





<h2>Encriptaicón por ROT13 (baja)</h2>
<p>Texto Original a encriptar: <code class="ori"><? echo $texto ?></code></p>
<p>Desplaza en el abecedario americano 13 caracteres</p>
<table>
   <tr>
        <th>Original</th>
        <td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
        <td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td>
        <td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td>
        <td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td>
    </tr> 
<tr>
        <th>Original</th>
        <td>A</td><td>B</td><td>C</td><td>D</td><td>E</td><td>F</td><td>G</td>
        <td>H</td><td>I</td><td>J</td><td>K</td><td>L</td><td>M</td>
        <td>N</td><td>O</td><td>P</td><td>Q</td><td>R</td><td>S</td><td>T</td>
        <td>U</td><td>V</td><td>W</td><td>X</td><td>Y</td><td>Z</td>
    </tr>
    <tr>
        <th>ROT13</th>
        <td>N</td><td>O</td><td>P</td><td>Q</td><td>R</td><td>S</td><td>T</td>
        <td>U</td><td>V</td><td>W</td><td>X</td><td>Y</td><td>Z</td>
        <td>A</td><td>B</td><td>C</td><td>D</td><td>E</td><td>F</td><td>G</td>
        <td>H</td><td>I</td><td>J</td><td>K</td><td>L</td><td>M</td>
    </tr>
</table>


<p>Encriptamos y sale:</p>
<code class="enc"><? echo str_rot13($texto); ?></code>

<p>Volvemos a aplicar la encriptación y obtenemos el texto original</p>
<code class="des"><? echo str_rot13(str_rot13($texto)); ?> </code>


<hr>
<h2>Base 64 (baja)</h2>
<h3>¿Cómo funciona?</h3>
<ul>
    <ol>Se toma el contenido original (binario)</ol>
    <ol>Se agrupa en bloques de 3 bytes (24 bits)</ol>
    <ol>Se divide en grupos de 6 bits</ol>
    <ol>Cada grupo se convierte a un carácter Base64</ol>
    <ol>Se usa este conjunto: A-Z a-z 0-9 + /</ol>
</ul>
<table>
    <tr>
        <td>Rango</td>
        <td>Caracteres</td>
    </tr>
    <tr>
    <td>0–25</td>
    <td>A–Z</td>
    </tr>
    <tr>
        <td>26–51</td>
        <td>a–z</td>
    <tr>
    </tr>
    <td>52–61</td>
    <td>0–9</td>
    <tr>
    </tr>
    <td>62</td>
    <td>+</td>
    <tr>
    </tr>
    <td>63</td>
    <td>/</td>
    </tr>
</table>


<a href="https://youtube.com/shorts/T4JW5T24Uy4?si=mkZatNcZv8-2wtGR">Ver video explicativo</a>

<p>Es más una codificación que una encriptación:</p>

<p>Texto Original a encriptar: <code class="ori"><? echo $texto ?></code></p>

<p>Encriptamos/Codificamos:
    <?
    $encB64= base64_encode($texto)
    ?>
    <code class="enc"><?echo $encB64 ?></code>
</p>

<p>Desencriptamos/Descodificamos
    <? 
    $decB64 = base64_decode($encB64)
    ?>
    <code class="des"><?echo $decB64 ?></code>
</p>





