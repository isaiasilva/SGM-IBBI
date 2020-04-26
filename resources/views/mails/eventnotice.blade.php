Olá,
Essa mensagem é para notificá-lo de que você foi adicionado a um evento de
<?php echo ucwords(\Auth::user()->branchname.' '.\Auth::user()->branchcode); ?>.

<h2><b>Detalhes do Evento:</b></h2>
<?php

?>
<p>Titulo: {{ $request->get('title') }}</p>
<p>Localização: {{ $request->get('location') }}</p>
<p>Tempo: {{$request->get('time')}}</p>
<p>Atribuir a: {{$request->get('title')}}</p>
<p>Por quem: {{$request->get('by_who')}}</p>
<p>Detalhes: {{$request->get('details')}}</p>

<h3>Obrigado!</h3>
{{ Auth::user()->branchname }}
