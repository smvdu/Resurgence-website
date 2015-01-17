
var VELOCITY = 0.2;
var PARTICLES = 400;

var mouse = {x:0, y:0};
var particles = [];
var colors = [ "#265F9B","#72CBDB","#FFFFFF" ];
var canvas = document.getElementById('projector');
var context;

if (canvas && canvas.getContext) {
    context = canvas.getContext('2d');

    for( var i = 0; i < PARTICLES; i++ ) {
        particles.push( { 
            x: Math.random()*window.innerWidth, 
            y: Math.random()*window.innerHeight, 
            vx: ((Math.random()*(VELOCITY*2))-VELOCITY),
            vy: ((Math.random()*(VELOCITY*2))-VELOCITY),
            size: Math.random()*2,
            color: colors[ Math.floor( Math.random() * colors.length ) ]
        } );
    }

    Initialize();
}

function Initialize() {
    canvas.addEventListener('mousemove', MouseMove, false);
    window.addEventListener('resize', ResizeCanvas, false);
    setInterval( TimeUpdate, 40 );

    ResizeCanvas();
}

function TimeUpdate(e) {

    context.clearRect(0, 0, window.innerWidth, window.innerHeight);

    var len = particles.length;
    var particle;

    for( var i = 0; i < len; i++ ) {
        particle = particles[i];

        if (!particle.frozen) {
            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x > window.innerWidth) {
                particle.vx = -VELOCITY - (Math.random() * (0.2 - 0) + 0);
            }
            else if (particle.x < 0) {
                particle.vx = VELOCITY + (Math.random() * (0.2 - 0) + 0);
            }
            else {
                particle.vx *= 1 + ((Math.random() * (0.2 - 0) + 0) * 0.005);
            }

            if (particle.y > window.innerHeight) {
                particle.vy = -VELOCITY - (Math.random() * (0.2 - 0) + 0);
            }
            else if (particle.y < 0) {
                particle.vy = VELOCITY + (Math.random() * (0.2 - 0) + 0);
            }
            else {
                particle.vy *= 1 + ((Math.random() * (0.2 - 0) + 0) * 0.005);
            }

            var distanceFactor = DistanceBetween( mouse, particle );
            distanceFactor = Math.max( Math.min( 15 - ( distanceFactor / 10 ), 10 ), 1 );

            particle.currentSize = particle.size*distanceFactor;
        }

        context.fillStyle = particle.color;
        context.beginPath();
        context.arc(particle.x,particle.y,particle.currentSize,0,Math.PI*2,true);
        context.closePath();
        context.fill();

    }
}

function MouseMove(e) {
    mouse.x = e.layerX;
    mouse.y = e.layerY;
}

function MouseDown(e) {
    var len = particles.length;

    var closestIndex = 0;
    var closestDistance = 1000;

    for( var i = 0; i < len; i++ ) {
        var thisDistance = DistanceBetween( particles[i], mouse );

        if( thisDistance < closestDistance ) {
            closestDistance = thisDistance;
            closestIndex = i;
        }

    }

    if (closestDistance < particles[closestIndex].currentSize) {
        particles[closestIndex].frozen = true;
    }
}

function ResizeCanvas(e) {
    canvas.width = window.innerWidth - 20;
    canvas.height = window.innerHeight - 13;
}

function DistanceBetween(p1,p2) {
    var dx = p2.x-p1.x;
    var dy = p2.y-p1.y;
    return Math.sqrt(dx*dx + dy*dy);
}