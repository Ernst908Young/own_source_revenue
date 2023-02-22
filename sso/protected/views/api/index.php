<h1>API Documentation :: SSO</h1>
<p><br /></p>
<table width="100%" border="1" style="border: 1 solid #000">
		<tr>
			<th width='10%'>S No</th>
			<th width='20%'>NAME</th>
			<th width='60%'>ENDPOINT</th>			
			<th width='5%'>PARAMETERS</th>		
			<th width='5%'>METHOD</th>
		</tr>

		<tr>
			<td>1</td>
			<td><a href="<?=$this->createUrl('/api/gettokeninfo')?>" target="_blank">gettokeninfo</a> </td>
			<td><?=API_BASEURL?>/api/gettokeninfo/token/{token}</td>
			<td><ol>
					<li><b>token</b> (String)</li>
				</ol>
			</td>
			<td>GET</td>
		</tr>
		
		<tr>
			<td>2</td>
			<td><a href="<?=$this->createUrl('/api/logouttoken')?>" target="_blank">logouttoken</a> </td>
			<td><?=API_BASEURL?>/api/logouttoken/token/{token}</td>
			<td><ol>
					<li><b>token</b> (String)</li>
				</ol>
			</td>
			<td>GET</td>
		</tr>
</table>