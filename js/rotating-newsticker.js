var scrollable = document.getElementById('newsticker-scrollable');
var scrollitems = document.getElementsByClassName('newsticker-item');

function activateNextItem()
{
  activateNext = false;
  removedDisappearing = false;
  for (var i = 0; i < scrollitems.length; i++) {
    if (activateNext) {
      scrollitems[i].classList.add('activated');
      activateNext = false;
      if (removedDisappearing) break;
        else continue;
    }
    if (scrollitems[i].classList.contains('activated')) {
      activateNext = true;
      scrollitems[i].classList.add('disappearing');
      scrollitems[i].classList.remove('activated');
    }
    else if (scrollitems[i].classList.contains('disappearing')) {
      scrollitems[i].classList.remove('disappearing');
      removedDisappearing = true;
    }
  }
  if (activateNext) {
    scrollitems[0].classList.add('activated');
  }
}

function MyTimer(callback, interval) {
  var timerID;
  var state = 0;
  this.pause = function () {
      if (state != 1) return;

      window.clearInterval(timerID);
      state = 2;
  };

  this.resume = function () {
      if (state != 2) return;
      timerID = window.setTimeout(this.timeoutCallback, interval / 2);
      state = 1;
  };

  this.timeoutCallback = function() {
       callback();
       timerID = window.setInterval(callback, interval);
  };

  timerID = window.setInterval(callback, interval);
  state = 1;

};

function setupRotatingNewsTicker()
{
  if (!scrollable || !scrollitems.length) {
      return;
  }

  scrollitems[0].classList.add('activated');
  if (scrollitems.length > 1) {
      var timer = new MyTimer( activateNextItem, 5000);

      scrollable.onmouseenter = function() { timer.pause(); };
      scrollable.onmouseleave = function() { timer.resume(); };
  }
}

setupRotatingNewsTicker();
