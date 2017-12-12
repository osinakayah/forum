<?php $__env->startSection(Config::get('chatter.yields.head')); ?>
    <?php if(Config::get('chatter.sidebar_in_discussion_view')): ?>
        <link href="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.css" rel="stylesheet">
    <?php endif; ?>
    <link href="/vendor/devdojo/chatter/assets/css/chatter.css" rel="stylesheet">
    <?php if($chatter_editor == 'simplemde'): ?>
        <link href="/vendor/devdojo/chatter/assets/css/simplemde.min.css" rel="stylesheet">
    <?php elseif($chatter_editor == 'trumbowyg'): ?>
        <link href="/vendor/devdojo/chatter/assets/vendor/trumbowyg/ui/trumbowyg.css" rel="stylesheet">
        <style>
            .trumbowyg-box, .trumbowyg-editor {
                margin: 0px auto;
            }
        </style>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div id="chatter" class="discussion">

	<div id="chatter_header" style="background-color:<?php echo e($discussion->color); ?>">
		<div class="container">
			<a class="back_btn" href="/<?php echo e(Config::get('chatter.routes.home')); ?>"><i class="chatter-back"></i></a>
			<h1><?php echo e($discussion->title); ?></h1><span class="chatter_head_details">Posted In <?php echo e(Config::get('chatter.titles.category')); ?><a class="chatter_cat" href="/<?php echo e(Config::get('chatter.routes.home')); ?>/<?php echo e(Config::get('chatter.routes.category')); ?>/<?php echo e($discussion->category->slug); ?>" style="background-color:<?php echo e($discussion->category->color); ?>"><?php echo e($discussion->category->name); ?></a></span>
		</div>
	</div>

	<?php if(Session::has('chatter_alert')): ?>
		<div class="chatter-alert alert alert-<?php echo e(Session::get('chatter_alert_type')); ?>">
			<div class="container">
	        	<strong><i class="chatter-alert-<?php echo e(Session::get('chatter_alert_type')); ?>"></i> <?php echo e(Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type'))); ?></strong>
	        	<?php echo e(Session::get('chatter_alert')); ?>

	        	<i class="chatter-close"></i>
	        </div>
	    </div>
	    <div class="chatter-alert-spacer"></div>
	<?php endif; ?>

	<?php if(count($errors) > 0): ?>
	    <div class="chatter-alert alert alert-danger">
	    	<div class="container">
	    		<p><strong><i class="chatter-alert-danger"></i> <?php echo e(Config::get('chatter.alert_messages.danger')); ?></strong> Please fix the following errors:</p>
		        <ul>
		            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <li><?php echo e($error); ?></li>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        </ul>
		    </div>
	    </div>
	<?php endif; ?>

	<div class="container margin-top">

	    <div class="row">

			<?php if(! Config::get('chatter.sidebar_in_discussion_view')): ?>
	        	<div class="col-md-12">
            <?php else: ?>
                <div class="col-md-3 left-column">
                    <!-- SIDEBAR -->
                    <div class="chatter_sidebar">
                        <button class="btn btn-primary" id="new_discussion_btn"><i class="chatter-new"></i> New <?php echo e(Config::get('chatter.titles.discussion')); ?></button>
                        <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>"><i class="chatter-bubble"></i> All <?php echo e(Config::get('chatter.titles.discussions')); ?></a>
                        <ul class="nav nav-pills nav-stacked">
                            <?php $categories = DevDojo\Chatter\Models\Models::category()->all(); ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="/<?php echo e(Config::get('chatter.routes.home')); ?>/<?php echo e(Config::get('chatter.routes.category')); ?>/<?php echo e($category->slug); ?>"><div class="chatter-box" style="background-color:<?php echo e($category->color); ?>"></div> <?php echo e($category->name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <div class="col-md-9 right-column">
            <?php endif; ?>

				<div class="conversation">
	                <ul class="discussions no-bg" style="display:block;">
	                	<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                		<li data-id="<?php echo e($post->id); ?>" data-markdown="<?php echo e($post->markdown); ?>">
		                		<span class="chatter_posts">
		                			<?php if(!Auth::guest() && (Auth::user()->id == $post->user->id)): ?>
		                				<div id="delete_warning_<?php echo e($post->id); ?>" class="chatter_warning_delete">
		                					<i class="chatter-warning"></i>Are you sure you want to delete this response?
		                					<button class="btn btn-sm btn-danger pull-right delete_response">Yes Delete It</button>
		                					<button class="btn btn-sm btn-default pull-right">No Thanks</button>
		                				</div>
			                			<div class="chatter_post_actions">
			                				<p class="chatter_delete_btn">
			                					<i class="chatter-delete"></i> Delete
			                				</p>
			                				<p class="chatter_edit_btn">
			                					<i class="chatter-edit"></i> Edit
			                				</p>
			                			</div>
			                		<?php endif; ?>
			                		<div class="chatter_avatar">
					        			<?php if(Config::get('chatter.user.avatar_image_database_field')): ?>

					        				<?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

					        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
					        				<?php if( (substr($post->user->{$db_field}, 0, 7) == 'http://') || (substr($post->user->{$db_field}, 0, 8) == 'https://') ): ?>
					        					<img src="<?php echo e($post->user->{$db_field}); ?>">
					        				<?php else: ?>
					        					<img src="<?php echo e(Config::get('chatter.user.relative_url_to_image_assets') . $post->user->{$db_field}); ?>">
					        				<?php endif; ?>

					        			<?php else: ?>
					        				<span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($post->user->email) ?>">
					        					<?php echo e(ucfirst(substr($post->user->email, 0, 1))); ?>

					        				</span>
					        			<?php endif; ?>
					        		</div>

					        		<div class="chatter_middle">
					        			<span class="chatter_middle_details"><a href="<?php echo e(\DevDojo\Chatter\Helpers\ChatterHelper::userLink($post->user)); ?>"><?php echo e(ucfirst($post->user->{Config::get('chatter.user.database_field_with_user_name')})); ?></a> <span class="ago chatter_middle_details"><?php echo e(\Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans()); ?></span></span>
					        			<div class="chatter_body">

					        				<?php if($post->markdown): ?>
					        					<pre class="chatter_body_md"><?php echo e($post->body); ?></pre>
					        					<?= \DevDojo\Chatter\Helpers\ChatterHelper::demoteHtmlHeaderTags( GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ) ); ?>
					        					<!--?= GrahamCampbell\Markdown\Facades\Markdown::convertToHtml( $post->body ); ?-->
					        				<?php else: ?>
					        					<?= $post->body; ?>
					        				<?php endif; ?>

					        			</div>
					        		</div>

					        		<div class="chatter_clear"></div>
				        		</span>
		                	</li>
	                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


	                </ul>
	            </div>

	            <div id="pagination"><?php echo e($posts->links()); ?></div>

	            <?php if(!Auth::guest()): ?>

	            	<div id="new_response">

	            		<div class="chatter_avatar">
		        			<?php if(Config::get('chatter.user.avatar_image_database_field')): ?>

		        				<?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

		        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
		        				<?php if( (substr(Auth::user()->{$db_field}, 0, 7) == 'http://') || (substr(Auth::user()->{$db_field}, 0, 8) == 'https://') ): ?>
		        					<img src="<?php echo e(Auth::user()->{$db_field}); ?>">
		        				<?php else: ?>
		        					<img src="<?php echo e(Config::get('chatter.user.relative_url_to_image_assets') . Auth::user()->{$db_field}); ?>">
		        				<?php endif; ?>

		        			<?php else: ?>
		        				<span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode(Auth::user()->email) ?>">
		        					<?php echo e(strtoupper(substr(Auth::user()->email, 0, 1))); ?>

		        				</span>
		        			<?php endif; ?>
		        		</div>

			            <div id="new_discussion">


					    	<div class="chatter_loader dark" id="new_discussion_loader">
							    <div></div>
							</div>

				            <form id="chatter_form_editor" action="/<?php echo e(Config::get('chatter.routes.home')); ?>/posts" method="POST">

						        <!-- BODY -->
						    	<div id="editor">
									<?php if( $chatter_editor == 'tinymce' || empty($chatter_editor) ): ?>
										<label id="tinymce_placeholder">Type Your Discussion Here...</label>
					    				<textarea id="body" class="richText" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
					    			<?php elseif($chatter_editor == 'simplemde'): ?>
					    				<textarea id="simplemde" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
									<?php elseif($chatter_editor == 'trumbowyg'): ?>
										<textarea class="trumbowyg" name="body" placeholder="Type Your Discussion Here..."><?php echo e(old('body')); ?></textarea>
									<?php endif; ?>
								</div>

						        <input type="hidden" name="_token" id="csrf_token_field" value="<?php echo e(csrf_token()); ?>">
						        <input type="hidden" name="chatter_discussion_id" value="<?php echo e($discussion->id); ?>">
						    </form>

						</div><!-- #new_discussion -->
						<div id="discussion_response_email">
							<button id="submit_response" class="btn btn-success pull-right"><i class="chatter-new"></i> Submit Response</button>
							<?php if(Config::get('chatter.email.enabled')): ?>
								<div id="notify_email">
									<img src="/vendor/devdojo/chatter/assets/images/email.gif" class="chatter_email_loader">
									<!-- Rounded toggle switch -->
									<span>Notify me when someone replies</span>
									<label class="switch">
									  	<input type="checkbox" id="email_notification" name="email_notification" <?php if(!Auth::guest() && $discussion->users->contains(Auth::user()->id)): ?><?php echo e('checked'); ?><?php endif; ?>>
									  	<span class="on">Yes</span>
										<span class="off">No</span>
									  	<div class="slider round"></div>
									</label>
								</div>
							<?php endif; ?>
						</div>
					</div>

				<?php else: ?>

					<div id="login_or_register">
						<p>Please <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>/login">login</a> or <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>/register">register</a> to leave a response.</p>
					</div>

				<?php endif; ?>

	        </div>


	    </div>
	</div>

    <?php if(Config::get('chatter.sidebar_in_discussion_view')): ?>
        <div id="new_discussion_in_discussion_view">

            <div class="chatter_loader dark" id="new_discussion_loader_in_discussion_view">
                <div></div>
            </div>

            <form id="chatter_form_editor_in_discussion_view" action="/<?php echo e(Config::get('chatter.routes.home')); ?>/<?php echo e(Config::get('chatter.routes.discussion')); ?>" method="POST">
                <div class="row">
                    <div class="col-md-7">
                        <!-- TITLE -->
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title of <?php echo e(Config::get('chatter.titles.discussion')); ?>" v-model="title" value="<?php echo e(old('title')); ?>" >
                    </div>

                    <div class="col-md-4">
                        <!-- CATEGORY -->
                        <select id="chatter_category_id" class="form-control" name="chatter_category_id">
                            <option value="">Select a Category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(old('chatter_category_id') == $category->id): ?>
                                    <option value="<?php echo e($category->id); ?>" selected><?php echo e($category->name); ?></option>
                                <?php else: ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <i class="chatter-close"></i>
                    </div>
                </div><!-- .row -->

                <!-- BODY -->
                <div id="editor">
                    <?php if( $chatter_editor == 'tinymce' || empty($chatter_editor) ): ?>
                        <label id="tinymce_placeholder">Add the content for your Discussion here</label>
                        <textarea id="body_in_discussion_view" class="richText" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
                    <?php elseif($chatter_editor == 'simplemde'): ?>
                        <textarea id="simplemde_in_discussion_view" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
                    <?php elseif($chatter_editor == 'trumbowyg'): ?>
                        <textarea class="trumbowyg" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
                    <?php endif; ?>
                </div>

                <input type="hidden" name="_token" id="csrf_token_field" value="<?php echo e(csrf_token()); ?>">

                <div id="new_discussion_footer">
                    <input type='text' id="color" name="color" /><span class="select_color_text">Select a Color for this Discussion (optional)</span>
                    <button id="submit_discussion" class="btn btn-success pull-right"><i class="chatter-new"></i> Create <?php echo e(Config::get('chatter.titles.discussion')); ?></button>
                    <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>" class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
                    <div style="clear:both"></div>
                </div>
            </form>

        </div><!-- #new_discussion -->
    <?php endif; ?>

</div>

<?php if($chatter_editor == 'tinymce' || empty($chatter_editor)): ?>
    <input type="hidden" id="chatter_tinymce_toolbar" value="<?php echo e(Config::get('chatter.tinymce.toolbar')); ?>">
    <input type="hidden" id="chatter_tinymce_plugins" value="<?php echo e(Config::get('chatter.tinymce.plugins')); ?>">
<?php endif; ?>
<input type="hidden" id="current_path" value="<?php echo e(Request::path()); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection(Config::get('chatter.yields.footer')); ?>

<?php if( $chatter_editor == 'tinymce' || empty($chatter_editor) ): ?>
	<script>var chatter_editor = 'tinymce';</script>
    <script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
    <script>
        var my_tinymce = tinyMCE;
        $('document').ready(function(){

            $('#tinymce_placeholder').click(function(){
                my_tinymce.activeEditor.focus();
            });

        });
    </script>
<?php elseif($chatter_editor == 'simplemde'): ?>
	<script>var chatter_editor = 'simplemde';</script>
    <script src="/vendor/devdojo/chatter/assets/js/simplemde.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/chatter_simplemde.js"></script>
<?php elseif($chatter_editor == 'trumbowyg'): ?>
	<script>var chatter_editor = 'trumbowyg';</script>
    <script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/trumbowyg.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/vendor/trumbowyg/plugins/preformatted/trumbowyg.preformatted.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/trumbowyg.js"></script>
<?php endif; ?>

<?php if(Config::get('chatter.sidebar_in_discussion_view')): ?>
    <script src="/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>
<?php endif; ?>

<script>
	$('document').ready(function(){

		var simplemdeEditors = [];

		$('.chatter_edit_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('editing');
			id = parent.data('id');
			markdown = parent.data('markdown');
			container = parent.find('.chatter_middle');

			if(markdown){
				body = container.find('.chatter_body_md');
			} else {
				body = container.find('.chatter_body');
				markdown = 0;
			}

			details = container.find('.chatter_middle_details');

			// dynamically create a new text area
			container.prepend('<textarea id="post-edit-' + id + '"></textarea>');
            // Client side XSS fix
            $("#post-edit-"+id).text(body.html());
			container.append('<div class="chatter_update_actions"><button class="btn btn-success pull-right update_chatter_edit"  data-id="' + id + '" data-markdown="' + markdown + '"><i class="chatter-check"></i> Update Response</button><button href="/" class="btn btn-default pull-right cancel_chatter_edit" data-id="' + id + '"  data-markdown="' + markdown + '">Cancel</button></div>');

			// create new editor from text area
			if(markdown){
				simplemdeEditors['post-edit-' + id] = newSimpleMde(document.getElementById('post-edit-' + id));
			} else {
                <?php if($chatter_editor == 'tinymce' || empty($chatter_editor)): ?>
                    initializeNewTinyMCE('post-edit-' + id);
                <?php elseif($chatter_editor == 'trumbowyg'): ?>
                    initializeNewTrumbowyg('post-edit-' + id);
                <?php endif; ?>
			}

		});

		$('.discussions li').on('click', '.cancel_chatter_edit', function(e){
			post_id = $(e.target).data('id');
			markdown = $(e.target).data('markdown');
			parent_li = $(e.target).parents('li');
			parent_actions = $(e.target).parent('.chatter_update_actions');
			if(!markdown){
                <?php if($chatter_editor == 'tinymce' || empty($chatter_editor)): ?>
                    tinymce.remove('#post-edit-' + post_id);
                <?php elseif($chatter_editor == 'trumbowyg'): ?>
                    $(e.target).parents('li').find('.trumbowyg').fadeOut();
                <?php endif; ?>
			} else {
				$(e.target).parents('li').find('.editor-toolbar').remove();
				$(e.target).parents('li').find('.editor-preview-side').remove();
				$(e.target).parents('li').find('.CodeMirror').remove();
			}

			$('#post-edit-' + post_id).remove();
			parent_actions.remove();

			parent_li.removeClass('editing');
		});

		$('.discussions li').on('click', '.update_chatter_edit', function(e){
			post_id = $(e.target).data('id');
			markdown = $(e.target).data('markdown');

			if(markdown){
				update_body = simplemdeEditors['post-edit-' + post_id].value();
			} else {
                <?php if($chatter_editor == 'tinymce' || empty($chatter_editor)): ?>
                    update_body = tinyMCE.get('post-edit-' + post_id).getContent();
                <?php elseif($chatter_editor == 'trumbowyg'): ?>
                    update_body = $('#post-edit-' + id).trumbowyg('html');
                <?php endif; ?>
			}

			$.form('/<?php echo e(Config::get('chatter.routes.home')); ?>/posts/' + post_id, { _token: '<?php echo e(csrf_token()); ?>', _method: 'PATCH', 'body' : update_body }, 'POST').submit();
		});

		$('#submit_response').click(function(){
			$('#chatter_form_editor').submit();
		});

		// ******************************
		// DELETE FUNCTIONALITY
		// ******************************

		$('.chatter_delete_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('delete_warning');
			id = parent.data('id');
			$('#delete_warning_' + id).show();
		});

		$('.chatter_warning_delete .btn-default').click(function(){
			$(this).parent('.chatter_warning_delete').hide();
			$(this).parents('li').removeClass('delete_warning');
		});

		$('.delete_response').click(function(){
			post_id = $(this).parents('li').data('id');
			$.form('/<?php echo e(Config::get('chatter.routes.home')); ?>/posts/' + post_id, { _token: '<?php echo e(csrf_token()); ?>', _method: 'DELETE'}, 'POST').submit();
		});

		// logic for when a new discussion needs to be created from the slideUp
        <?php if(Config::get('chatter.sidebar_in_discussion_view')): ?>
            $('.chatter-close').click(function(){
                $('#new_discussion_in_discussion_view').slideUp();
            });
            $('#new_discussion_btn, #cancel_discussion').click(function(){
                <?php if(Auth::guest()): ?>
                    window.location.href = "/<?php echo e(Config::get('chatter.routes.home')); ?>/login";
                <?php else: ?>
                    $('#new_discussion_in_discussion_view').slideDown();
                    $('#title').focus();
                <?php endif; ?>
            });

            $("#color").spectrum({
                color: "#333639",
                preferredFormat: "hex",
                containerClassName: 'chatter-color-picker',
                cancelText: '',
                chooseText: 'close',
                move: function(color) {
                    $("#color").val(color.toHexString());
                }
            });

            <?php if(count($errors) > 0): ?>
                $('#new_discussion_in_discussion_view').slideDown();
                $('#title').focus();
            <?php endif; ?>
        <?php endif; ?>

	});
</script>

<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(Config::get('chatter.master_file_extend'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>