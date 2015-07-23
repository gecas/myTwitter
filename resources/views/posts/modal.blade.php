{!! Form::open(['method'=>'DELETE', 'url'=>'posts/' . $post->id ]) !!}
                        <span class="user-delete" title="Ištrinti">
                            <i onclick="showDeleteForm(2)" class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#myModal"></i>
                             <div class="modal fade" id="myModal" role="dialog">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <h4 class="modal-title">Delete</h4>
                               </div>
                               <div class="modal-body">
                                 <p>Do you really want to delete ? &hellip;</p>
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                 {!! Form::submit('Delete!',['class'=>'btn btn-danger']) !!}
                               </div>
                             </div><!-- /.modal-content -->
                           </div><!-- /.modal-dialog -->
                         </div><!-- /.modal -->
                        </span>
                        {!! Form::close() !!}