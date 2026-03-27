SELECT
#obras
obras.*,

#autores
autores.id AS id_autor,
autores.nombre AS autor,
autores.nacionalidad,
autores.descripcion AS autor_descripcion,
autores.imagen AS img_autor,
autores.fecha_nacimiento,
autores.fecha_muerte,

#disciplinas
disciplinas.id AS id_disciplina,
disciplinas.nombre AS disciplina,
disciplinas.imagen AS img_disciplina

FROM obras
# Obras-Autores
 JOIN obras_autores ON obras.id = obras_autores.obra_id
 JOIN autores ON autores.id = obras_autores.autor_id

# Obras-Disciplina
 JOIN obras_disciplinas ON obras.id = obras_disciplinas.obra_id
 JOIN disciplinas ON disciplinas.id = obras_disciplinas.disciplina_id
