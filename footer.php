  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script src="js/chart.min.js"></script>
  <script src="js/init.js"></script>
  <script>
    $(document).ready(function() {
      var todaysDate = new Date();

      function convertDate(date) {
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth()+1).toString();
        var dd  = date.getDate().toString();

        var mmChars = mm.split('');
        var ddChars = dd.split('');

        return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
      }

      var dateToday = convertDate(todaysDate);
      // console.log(convertDate(todaysDate)); // Returns: 2015-08-25
      // Initialize modal
      $('.modal').modal();

      // Initialize select list
      $('select').material_select();

      // Initialize datepicker
      $('.datepicker').pickadate({
        format: 'yyyy-mm-dd',
        min: dateToday
      });

      // Hide messagebox after 5 second
      setTimeout(function(){
        $('#msgBox').hide();
      }, 5000);
    });
  </script>
</body>
</html>
