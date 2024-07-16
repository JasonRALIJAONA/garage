<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>

                <script>
                    $(document).ready(function() {
                      var calendarEl = document.getElementById('calendar');
                      var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        locale: 'fr', // Pour afficher le calendrier en français
                        headerToolbar: {
                          left: 'prev,next today',
                          center: 'title',
                          right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },
                        events: function(fetchInfo, successCallback, failureCallback) {
                          $.ajax({
                            url: "<?php echo base_url('reservation/get_reservations'); ?>",
                            type: 'GET',
                            success: function(data) {
                              var events = JSON.parse(data);
                              successCallback(events);
                            },
                            error: function() {
                              failureCallback();
                            }
                          });
                        }
                      });
                      calendar.render();
                    });
                </script>
            </div>
        </div>
    </div>