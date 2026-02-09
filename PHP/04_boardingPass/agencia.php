<header>
<h1>Viajes Alonso</h1>
<p>Constructor de tarjetas de embarque/boardingpass</p>
</header>

<main>

<!-- boardingcard.php? o=Palma & d=Oviedo & p=Sergio & s=M & f=2026-06-24-->

<form action="boardingcard.php" method="get">
    <label>Origen:  <input type="text" name="o">    </label>
    <label>Destino: <input type="text" name="d">    </label>
    <label>Pasajero:<input type="text" name="p">    </label>
    <label>Sexo:   <select name="s" >
        <option value="M">Mozu</option>
        <option value="F">Moza</option>
        <option value="N">Neutro</option>
    </select></label>

    <label>Fecha:   <input type="date" name="f">    </label>
    <input type="submit" value="Generar Tarjeta">
</form>
</main>

<footer>
<p>&copy; Boardingpass Generator</p>
</footer>


<style>
    html{font-family:sans-serif;}
    label{display:block; padding: 2px 0;}
</style>