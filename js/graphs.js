function rnd_snd() {
  return (Math.random() * 2 - 1) +
         (Math.random() * 2 - 1) +
         (Math.random() * 2 - 1);
}
function rnd(mean, stdev) {
  return Math.round(rnd_snd() * stdev + mean);
}
(function() {
  var
    container = document.getElementById('graphing-container'),
    d1 = [],
    d2 = [],
    graph, i, j,
    gauss = {};

  for (i = 0; i < 80; i += 0.5) {
    d1.push([i, rnd(100, 5)]);
  }
  for (j = 0; j < 100; j += 1) {
    var val = Math.floor(rnd(83, 5));
    if (val in gauss) {
      gauss[val] += 1;
    } else {
      gauss[val] = 1;
    }
  }
  console.log(gauss);
  /*for (i = 0; i < 20; i += 0.5) {
    d2.push([i, 3*i]);
  }*/
  var g1 = [];
  for (var key in gauss) {
    g1.push([parseInt(key, 10), gauss[key]]);
  }

  console.log('g1:');
  console.log(g1);
  console.log('x');
  console.log(_.min(g1, function(d){return d[0];})[0]);
  console.log(_.max(g1, function(d){return d[0];}));
  console.log('y');
  console.log(_.max(g1, function(d){return d[0];}));
  console.log(_.max(g1, function(d){return d[1];}));
  graph = Flotr.draw(container, [g1], {
      xaxis: {
        min: _.min(g1, function(d){return d[0];})[0], 
        max: _.max(g1, function(d){return d[0];})[0]
      },
      yaxis: {
        min: 0,
        max: _.max(g1, function(d){return d[1];})[1]
      }
  });

})();
