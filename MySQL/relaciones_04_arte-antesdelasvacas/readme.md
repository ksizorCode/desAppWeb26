

SELECT *
FROM obras
# Obras-Autores
 JOIN obras_autores ON obras.id = obras_autores.obra_id
 JOIN autores ON autores.id = obras_autores.autor_id
# Obras-Disciplina
 JOIN obras_disciplinas ON obras.id = obras_disciplinas.obra_id
 JOIN disciplinas ON disciplinas.id = obras_disciplinas.disciplina_id