<div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="myModalLabel1">Add Test Case</h4 >
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div><!-- Modal header -->

                <div class="modal-body">

                  <div class="col-md-12">
                    <input type="hidden" name="FileUploadQE_ID" value="">

                    <div class="form-group row">
                      <label for="Category" class="col-md-4 label-control">Select Module *</label>
                      <div class="col-md-8">
                        <select name="module_id" id="module" required="required" class="form-control fileval">
                         
                          <option value="">select</option>
                          
                        @foreach($allCategories as $category)
                            <option value=" {{ $category->id }}"> {{ $category->title }}</option>
                    
                          @endforeach  
                        
                        </select>
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    <div class="form-group row">
                      <label  class="col-md-4 label-control">Test Case Summary</label>
                      <div class="col-md-8">
                        <textarea name="summary" class="form-control fileval" placeholder="Add Summary" required></textarea>
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    <div class="form-group row">
                      <label class="col-md-4 label-control">Description</label>
                      <div class="col-md-8">
                        <textarea name="description" class="form-control fileval" placeholder="Add Description"></textarea>
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    <div class="form-group row">
                      <label class="col-md-4 label-control">File Upload *</label>
                      <div class="col-md-8">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" required="required" name="file">
                      </div><!-- col-md-8 -->
                    </div><!-- form-group col-md-12 -->

                    

                  </div><!-- row -->
                </div><!-- Modal body -->

                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-md pull-left" data-dismiss="modal">Cancel</button>
                  <button id="Attachment_submit" type="submit" class="btn btn-success btn-md block-page">Save</button>
                </div><!-- Modal footer-->

              </div><!-- Modal content-->
            </form>
          </div><!-- Modal-dialog -->
        </div><!-- Modal -->
