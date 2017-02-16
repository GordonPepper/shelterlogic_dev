window.paceOptions = {
  ajax: false, // disabled
  document: true, // disabled
  eventLag: true, // disabled
  elements: {
    selectors: ['body']
  }
};
//alert(paceOptions);
pace.start(paceOptions);