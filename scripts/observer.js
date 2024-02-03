// First we select the element we want to target
const target = document.querySelector('.animated-text');

const options = {

    threshold: 0.5,
  }

  const aoptions = {
    threshold: 0.8,
  }

  const options1 = {
    threshold: 0.2,
  }

// Next we want to create a function that will be called when that element is intersected
function handleIntersection(entries) {
  // The callback will return an array of entries, even if you are only observing a single item
  entries.map((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible')
    } else {
      entry.target.classList.remove('visible')
    }
  });
}

// Next we instantiate the observer with the function we created above. This takes an optional configuration
// object that we will use in the other examples.
const observer = new IntersectionObserver(handleIntersection,options);

// Finally start observing the target element
observer.observe(target);


// contact start
const targetc = document.querySelector('.contact');
function handleIntersectionc(entries) {

  entries.map((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('vis')
    } else {
      entry.target.classList.remove('vis')
    }
  });
}
const observerc = new IntersectionObserver(handleIntersectionc,options);
observerc.observe(targetc);
//end of contact 

// service start
const targets = document.querySelector('.service');
function handleIntersections(entries) {

  entries.map((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add('vs')
    } else {
      entry.target.classList.remove('vs')
    }
  });
}
const observers = new IntersectionObserver(handleIntersections,options);
observers.observe(targets);
//end of contact





const target1 = document.querySelectorAll('.text-non');


// Next we want to create a function that will be called when that element is intersected
function handleIntersection1(entries) {
// The callback will return an array of entries, even if you are only observing a single item
entries.forEach((entry) => {
  if (entry.isIntersecting) {
    entry.target.classList.add('text-opa')
  } else {
    entry.target.classList.remove('text-opa')
  }
});
}

// Next we instantiate the observer with the function we created above. This takes an optional configuration
// object that we will use in the other examples.
const observer1 = new IntersectionObserver(handleIntersection1,options1);

// Finally start observing the target element
target1.forEach(function (i) {
 
      observer1.observe(i);
  
});





/* home */
const htarget = document.querySelectorAll('.home');
function handleIntersection2(entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      document.getElementById("home-active").classList.add('active-bg');
    } else {
      document.getElementById("home-active").classList.remove('active-bg');
    }
  });
}
const hobserver = new IntersectionObserver(handleIntersection2,aoptions);
htarget.forEach(function (i) {
 
  hobserver.observe(i);

});
/* home end */



/* about us */

const atarget = document.querySelectorAll('.about-us');
function handleIntersection3(entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      document.getElementById("about-active").classList.add('active-bg');
    } else {
      document.getElementById("about-active").classList.remove('active-bg');
    }
  });
}
const aobserver = new IntersectionObserver(handleIntersection3,aoptions);
atarget.forEach(function (i) {
 
  aobserver.observe(i);

});
/* about us */

/*our team*/
const ttarget = document.querySelector('.our-team');
function handleIntersection4(entries) {
  entries.map((entry) => {
    if (entry.isIntersecting) {
      document.getElementById("team-active").classList.add('active-bg');
    } else {
      document.getElementById("team-active").classList.remove('active-bg');
    }
  });
}
const tobserver = new IntersectionObserver(handleIntersection4,aoptions);
tobserver.observe(ttarget);

/*contact*/
const ctarget = document.querySelector('.contact');
function handleIntersection5(entries) {
  entries.map((entry) => {
    if (entry.isIntersecting) {
      document.getElementById("contact-active").classList.add('active-bg');
    } else {
      document.getElementById("contact-active").classList.remove('active-bg');
    }
  });
}
const cobserver = new IntersectionObserver(handleIntersection5,aoptions);
cobserver.observe(ctarget);