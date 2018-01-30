<div class="modal fade" id="requestOffer-catList" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="locationModalLabel">Select category For Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="selectRequestCat">
                        <label class="alaert alert-warning">Categories</label></br>
                        <div class="col-md-12">                     
                        @foreach($category as $cat)
                         <div class="col-md-4"> 
                          <input type="checkbox" class="cat-requestOffer" name="" id="{{$cat->id}}" value="">
                          <span>{{$cat->name}}</span></br>
                        </div>
                         @endforeach
                         </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="sendRequest">Send Request</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                  </div>
                </div>
              </div>
            </div>