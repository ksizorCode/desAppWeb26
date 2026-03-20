## Trucos Markdown en Github:

## 1. 🚨 Alertas (Callouts) - Nuevo y Destacado
GitHub permite resaltar información importante usando citas especiales: 

[!NOTE] (Nota): Información útil.
[!TIP] (Consejo): Consejos para mejorar algo.
[!IMPORTANT] (Importante): Clave para el objetivo.
[!WARNING] (Advertencia): Urgente para evitar problemas.
[!CAUTION] (Precaución): Riesgos negativos.

Ejemplo:

```markdown
[!NOTE] (Nota): Información útil.
[!TIP] (Consejo): Consejos para mejorar algo.
[!IMPORTANT] (Importante): Clave para el objetivo.
[!WARNING] (Advertencia): Urgente para evitar problemas.
[!CAUTION] (Precaución): Riesgos negativos.
```
## 2. 🧩 Secciones Contraídas (<details>)
Ideal para ocultar información larga o técnica (logs, ejemplos de código) y mantener el README limpio. 

<details>
<summary>Haz clic para ver más</summary>
Texto oculto o código aquí.
</details>

```markdown
<details>
<summary>Haz clic para ver más</summary>
Texto oculto o código aquí.
</details>
```

## 3. 🖼️ Imágenes, GIFs y Modos Claro/Oscuro
Arrastrar y soltar: Puedes arrastrar imágenes directamente al editor de GitHub y las subirá automáticamente.
Modo Claro/Oscuro: Usa etiquetas HTML para mostrar imágenes diferentes según el tema del usuario: 

```markdown
<picture>
  <source media="(prefers-color-scheme: dark)" srcset="URL-IMAGEN-OSCURO">
  <source media="(prefers-color-scheme: light)" srcset="URL-IMAGEN-CLARO">
  <img alt="Texto alternativo" src="URL-DEFAULT">
</picture>
```

<picture>
  <source media="(prefers-color-scheme: dark)" srcset="URL-IMAGEN-OSCURO">
  <source media="(prefers-color-scheme: light)" srcset="URL-IMAGEN-CLARO">
  <img alt="Texto alternativo" src="URL-DEFAULT">
</picture>

## 4. 💻 Resaltado de Sintaxis en Código
Para que el código tenga colores, añade el lenguaje después de las tres comillas invertidas (```): 

```python
python (Python)
{content: }
```

js (JavaScript)
{content: }
python (Python)
{content: }
bash (Terminal)

5. 📦 Listas de Tareas Interactivas
Crea checklists interactivas que se pueden marcar sin editar el código: 

- [x] Tarea terminada
- [ ] Tarea pendiente

```markdown
- [x] Tarea terminada
- [ ] Tarea pendiente
```

6. 🔗 Vínculos Relativos y Anclas
Vínculos relativos: Enlaza a otros archivos en tu repo sin usar la URL completa: [Documentación](./docs/guia.md).
Anclas automáticas: GitHub genera anclas para los títulos. ## Mi Título se convierte en #mi-titulo. 


7. 🎭 Emojis y Octicons
Emojis: Usa el código :nombre_emoji: (ej. :rocket:, :bug:).
Octicons: GitHub tiene sus propios iconos (requiere sintaxis Liquid en repositorios de documentación): {% octicon "plus" %}. 


8. 📊 Tablas Avanzadas
Puedes crear tablas organizadas y alinear texto (izquierda, centro, derecha): 

| Alinear | Izquierda | Derecha |
|:---|:---:|---:|
| Dato | Más | 100 |


```markdown

| Alinear | Izquierda | Derecha |
|:---|:---:|---:|
| Dato | Más | 100 |
```

9. 🎨 Badges (Insignias)
Usa Shields.io para añadir placas de estado, versión o licencia en la parte superior del README. 


10. 📝 Ejemplo plantilla rápida README.md

# Nombre del Proyecto
![Logo](URL-LOGO)

> Breve descripción del proyecto.

## 🛠️ Instalación
```bash
npm install
🚀 Uso
Ejemplo rápido de uso.
💡 Características
[!TIP]
Caraterística 1
🤝 Contribución
Tarea A
Tarea B
{content: }
