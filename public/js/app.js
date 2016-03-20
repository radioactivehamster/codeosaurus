(function () {
    'use strict';

    var editor = document.getElementById('editor')
    var logger = document.getElementById('logger')

    editor.addEventListener('keyup', function (event) {
        console.log(event)

        var log     = document.createElement('div')
        var content = document.createTextNode(event.key)

        log.className = 'log'

        log.appendChild(content)
        logger.appendChild(log)
    })
})()
