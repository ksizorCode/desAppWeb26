<?php
$lista = [
    // id del video         // título                               // grupo
    ['v' => '0S43IwBF0uM', 't' => 'Star Guitar',                    'g' => 'The Chemical Brothers'],
    ['v' => 'dTAAsCNK7RA', 't' => 'Here It Goes Again',             'g' => 'OK Go'],
    ['v' => '63vqob-MljQ', 't' => 'Come Into My World',             'g' => 'Kylie Minogue'],
    ['v' => 'K4dx42YzQCE', 't' => 'The Hardest Button To Button',   'g' => 'The White Stripes'],
    ['v' => '0J2QdDbelmY', 't' => 'Seven Nation Army',              'g' => 'The White Stripes'],
    ['v' => 'wCDIYvFmgW8', 't' => 'Weapon Of Choice',               'g' => 'Fatboy Slim'],
    ['v' => 'djV11Xbc914', 't' => 'Take on Me',                     'g' => 'A-ha'],
    ['v' => 'yuTMWgOduFM', 't' => 'Common People',                  'g' => 'Pulp'],
    ['v' => 'lmc21V-zBq0', 't' => 'Run Boy Run',                    'g' => 'Woodkid'],
    ['v' => 'VYOjWnS4cMY', 't' => 'This is America',                'g' => 'Childish Gambino'],
    ['v' => 'mYUq0oQvqB0', 't' => 'Wake Me Up When September Ends', 'g' => 'Green Day '],
    ['v' => 'hAx6mYeC6pY', 't' => 'Murder on the Dance Floor',      'g' => 'Sophie Ellis'],
    ['v' => 'AJWtLf4-WWs', 't' => 'Stronger',                       'g' => 'Bridney Spears'],
    ['v' => 'VV1XWJN3nJo', 't' => 'Torn',                           'g' => 'Natalie Imbruglia '],
    ['v' => 'eBG7P-K-r1Y', 't' => 'Virtual Insanity',              'g' => 'Jamiroquai'],
    ['v' => 'hTWKbfoikeg', 't' => 'Smells Like Teen Spirit',       'g' => 'Nirvana'],
    ['v' => 'fLexgOxsZu0', 't' => 'Single Ladies',                 'g' => 'Beyoncé'],
    ['v' => 'Zi_XLOBDo_Y', 't' => 'Billie Jean',                   'g' => 'Michael Jackson'],
    ['v' => 'OPf0YbXqDm0', 't' => 'Uptown Funk',                   'g' => 'Mark Ronson ft. Bruno Mars'],
    ['v' => 'RgKAFK5djSk', 't' => 'See You Again',                 'g' => 'Wiz Khalifa'],
    ['v' => 'ktvTqknDobU', 't' => 'Radioactive',                   'g' => 'Imagine Dragons'],
    ['v' => 'pRpeEdMmmQ0', 't' => 'Wicked Game',                   'g' => 'Chris Isaak'],
    ['v' => 'Xtc6uXK9N0Q', 't' => 'Bitter Sweet Symphony',          'g' => 'The Verve'],
    ['v' => 'sOnqjkJTMaA', 't' => 'Thriller',                      'g' => 'Michael Jackson']
];
?>

<h1>Top Búsquedas</h1>

<ul class="galeria">
<?
    foreach($lista as $elemento){
        echo "<li>
        <a href='https://www.youtube.com/watch?v={$elemento['v']}' target='_blank'>
                <img src='https://img.youtube.com/vi/{$elemento['v']}/hqdefault.jpg'>
                <h2>{$elemento['t']}</h2>
                <p>{$elemento['g']}</p>
            </a></li>
            ";
    }
?>
</ul>



<style>
    body{
        font-family: sans-serif;
        padding: 20px;
        background:lightgray;
    }

    ul{
        display:flex;
        flex-wrap:wrap;
        gap:10px;

        list-style:none;
        padding:0;
    }
    li{
        padding:18px;
        border-radius:18px;
        background:white;
        flex: 1 1 0;
        min-width:200px;
    }

    img{
        max-width:100%;
    }
    </style>