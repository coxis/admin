			<div class="block">
				<div class="block_head">
					<div class="bheadl"></div>
					<div class="bheadr"></div>
					<h2><a href="<% echo $this->url_for('index') %>"><% echo ucfirst($_entities) %></a></h2>
					<ul>
						<li><a href="<% echo $this->url_for('new') %>"><% echo __('Add') %></a></li>
					</ul>
					<%
					$searchForm->open();
					echo $searchForm->search->def(array(
						'attrs'	=>	array(
							'class'	=>	'text',
							'placeholder'	=>	'Search',
						),
					));
					$searchForm->close();
					%>
				</div>	
				
				<div class="block_content">
				<!-- 	<div class="block small left" style="width:100%">
						<div class="block_head">
							<div class="bheadl"></div>
							<div class="bheadr"></div>
							<h2>Liste</h2>	
						</div>	
						<div class="block_content"> -->
						
							<% \Asgard\Core\App::get('flash')->showAll() %>
						
							<% if(sizeof($<?php echo $entity['meta']['plural'] ?>) == 0): %>
							<div style="text-align:center; font-weight:bold"><% echo __('No element') %></div>
							<% else: %>
							<form action="" method="post">
								<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
								
									<thead>
										<tr>
											<th width="10"><input type="checkbox" class="check_all" /></th>
											<th><% echo __('Created at') %></th>
											<th><% echo __('Title') %></th>
											<td>&nbsp;</td>
										</tr>
									</thead>
									
									<tbody>
										<% foreach($<?php echo $entity['meta']['plural'] ?> as $<?php echo $entity['meta']['name'] ?>) { %>								
											<tr>
												<td><input type="checkbox" name="id[]" value="<% echo $<?php echo $entity['meta']['name'] ?>->id %>" /></td>
												<td><% echo $<?php echo $entity['meta']['name'] ?>->created_at %></td>
												<td><a href="<% echo $this->url_for('edit', array('id'=>$<?php echo $entity['meta']['name'] ?>->id)) %>"><% echo $<?php echo $entity['meta']['name'] ?> %></a></td>
												<td class="actions">
													<% \Asgard\Core\App::get('hook')->trigger('asgard_<?php echo $entity['meta']['name'] ?>_actions', $<?php echo $entity['meta']['name'] ?>, null, true) %>
													<a class="delete" href="<% echo $this->url_for('delete', array('id'=>$<?php echo $entity['meta']['name'] ?>->id)) %>"><% echo __('Delete') %></a>
												</td>
											</tr>
										<% } %>
									</tbody>
									
								</table>
								<div class="tableactions">
									<select name="action">
										<option><% echo __('Actions') %></option>
										<% foreach($globalactions as $action): %>
										<option value="<% echo $action['value'] %>"><% echo $action['text'] %></option>
										<% endforeach %>
									</select>
									<input type="submit" class="submit tiny" value="<% echo __('Apply') %>" />
								</div>		
								
								<% if(isset($paginator) && $paginator->getPages()>1): %>
								<div class="pagination right">
									<% $paginator->show() %>
								</div>
								<% endif %>
								
							</form>
							<% endif %>
						</div>		<!-- .block_content ends -->
						<!-- <div class="bendl"></div>
						<div class="bendr"></div>
					</div> -->
					<!--<div class="block small right" style="width:19%">
						<div class="block_head">
							<div class="bheadl"></div>
							<div class="bheadr"></div>
							
							<h2>Filtres</h2>
						</div>	
						<div class="block_content">
							<%
							%>
							
						</div>		
						
						<div class="bendl"></div>
						<div class="bendr"></div>
					</div>-->
				<div class="bendl"></div>
				<div class="bendr"></div>
			</div>		