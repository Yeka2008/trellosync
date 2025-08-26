# TrelloSync #

TrelloSync es un plugin de tipo local llamado (/local/trellosync), que puede ser utilizado en cualquier curso dentro de la plataforma de Moodle siempre que el usuario cuente con las credenciales necesarias, este plugin brindara  al usuario la oportunidad de visualizar, crear, actualizar y eliminar tarjetas de un tablero de Trello de forma sencilla y desde la plataforma Moodle manteniendo sincronizada la información en ambos sistemas, facilitando la gestión y el seguimiento de proyectos y tareas de una forma visual y ordenada además le evitará al usuario tener que cambiar entre múltiples plataformas.

## Tabla de Contenido ##

- [Prerequisitos](*prerrequisitos)
- [Instalación del Plugin](*instalación_del_plugin)
- [Funcionalidades](*funcionalidades)
- [Configuración credenciales de Trello](*configuración_de_credenciales_de_trello)
- [Creación de Tareas](*creación_de_tareas)
- [Actualizar tarjetas](*actualizar_tarjetas)
- [Eliminar tarjetas](*eliminar_tarjetas)
- [Documentación Técnica](*documentación_técnica)
- [Estructura de archivos, Trello Sync (local_trellosync)](*Estructura_de_archivos,_Trello_Sync_(local_trellosync))


## prerrequisitos ##

Para poder hacer uso del plugin, el usuario debe contar con los siguientes requisitos:

- Tener sus credenciales de ingreso a la plataforma de Moodle y contar con los permisos.

- Debe haber creado al menos un curso.

- Estar registrado en Trello 

- Haber obtenido con anterioridad el Token, la Apikey y el Id del tablero de Trello. 

- Si aún no tiene sus credenciales de Trello  estas deben ser obtenidas  ingresando al siguiente enlace ir a [Trello A pi Key](https://developer.atlassian.com/cloud/trello/guides/rest-api/api-introduction/)

## Instalación ##

1. El ususario debe estar logueado en la plataforma de moodle y contar con permisos de administrador.
   
2. dirigirse a la pestaña de administración del sitio, seleccionar la opcion pluguins y luego instalar pluguin.
**site administratión > Plugins > Install plugins.** y continua con el proceso de instalación estandar para plugins de moodle. 

## Funcionalidades ##

- Configurar Credenciales de **Trello** (Apikey, token, ID del tablero) desde la interfaz.
- Crear tarjetas en Trello desde moodle.
- Sincronizar tareas de un curso con un tablero de Trello.
- Actualizar tareas existentes desde moodle.
- Eliminar tarjetas desde moodle con confirmación.

## guia de Usuario ##
### Configuración de Credenciales ##
Para la configuración de las credenciales de Trello el usuario debe:
1. dirigirse a la sección de administracion del curso seleccionar la opcion más y en el menú desplazarse hasta la opción trello Sync. **(Curso > More/mas > Trello Sync)**

2. Diligenciar el formulario con los campos apikey, token y Id del tablero (credenciales de Trello) que aparecera una vez haya dado click en trello sync.

3. Guardar cambios. Luego debe aparecer un mensaje de configuración guardada. 

## Creación de Tarjetas ##

Una vez aya guardado las credenciales de Trello(Apikey, token, ID tablero) el usuario debera:
1. dirigirse de nuevo al menú de administración del sitio, seleccionar opcción más y desplazarse hasta proyecto trello y dar click. **(Curso > More/mas > Project Trello)**

2. Diligencia el formulario para la creación de tareas el cual cuenta con tres campos titulo, descripción y por ultimo el campo de lista que tiene un menu desplegable con el listado de las listas para que pueda seleccionar en que lista desea crear la tarjeta.

3. Este formulario debe ser diligenciado en su totalidad, en caso de haber algún espacio sin llenar, arrojará un error. Cuando el formuario este completo de click en el botón crear tarjeta y entonces  podrá ver la nueva tarjeta en la parte inferior del formulario y en la lista que haya seleccionado.

## Actualización de Tarjetas ##

 Debajo del formulario para cración de tarjetas **(Curso > More/mas > Project Trello)** podrá ver las listas con sus respectivas tarjetas y dentro de cada tarjeta encontrará un botón actualizar.

-Una vez haya dado click en el botón actuallizar de la tarjeta que desee modificar se abrirá una página con la información de esta tarjeta, todos los campos son editables (titulo, descripción y lista).

-cuando ya tenga editada la tarjeta debera dar click en el botón actualizar tarjeta para guardar los cambios.

## Eliminar Tarjeta ##

-Para eliminar la tarjeta en la pagina del formulario de crear tarjetas **(Curso > More/mas > Project Trello)** debe dar click al botón de eliminar que encontrará en cada tarjeta.

-El botón Eliminar abrirá una página con dos botones uno si, eliminar o no, cancelar, donde podra confirmar la acción en ambos casos el sistema mostrara un mensaje y lo guara de nuevo a la página de proyecto trello.

## License ##

2025 Nubia Culma<nubiaculma@openlms.net

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
