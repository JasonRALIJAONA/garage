<div class="main-panel">
    <div class="content-wrapper">
        <div class="card" style="background-color: #384c5057;">
            <div class="card-body">
            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                <div id="calendar"></div>

                <!-- Modal pour ajouter un rendez-vous -->
                <div class="modal fade" id="addRdvModal" tabindex="-1" role="dialog" aria-labelledby="addRdvModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addRdvModalLabel">Ajouter un rendez-vous</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addRdvForm">
                                    <div class="form-group">
                                        <label for="client">Client</label>
                                        <select id="client" name="client_id" class="form-control" required>
                                            <option value="">Sélectionnez un client</option>
                                            <?php foreach ($clients as $client) { ?>
                                                <option value="<?php echo $client->id; ?>"><?php echo $client->numero_voiture; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="service">Service</label>
                                        <select id="service" name="service_id" class="form-control" required>
                                            <option value="">Sélectionnez un service</option>
                                            <?php foreach ($services as $service) { ?>
                                                <option value="<?php echo $service['id']; ?>"><?php echo $service['type']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_debut">Date et heure de début</label>
                                        <input type="datetime-local" id="date_debut" name="date_debut" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
                                  error: function(jqXHR, textStatus, errorThrown) {
                                      console.error('Erreur lors de la récupération des événements:', textStatus, errorThrown);
                                      alert('Erreur lors de la récupération des événements. Veuillez réessayer plus tard.');
                                      failureCallback();
                                  }
                              });
                          },
                            dateClick: function(info) {
                                var selectedDate = info.dateStr + 'T08:00'; // Date cliquée avec heure de début par défaut à 08:00
                                $('#date_debut').val(selectedDate);
                                $('#addRdvModal').modal('show');
                            }
                        });
                        calendar.render();

                        $('#addRdvForm').on('submit', function(e) {
                            e.preventDefault();
                            $.ajax({
                                url: "<?php echo base_url('reservation/process_reservation'); ?>",
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(response) {
                                    $('#addRdvModal').modal('hide');
                                    calendar.refetchEvents();
                                },
                                error: function() {
                                    alert('Une erreur est survenue lors de l\'ajout du rendez-vous.');
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>