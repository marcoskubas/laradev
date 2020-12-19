@component('mail::message')

<h1>Parabéns por garantir a sua vaga na turma LaraDev</h1>

<p>Para fazer login na plataforma utilizar o seu email ({{ $user->email }}) juntamente com a sua senha de cadastro.</p>

@component('mail::button', ['url' => 'https:www.upinside.com.br'])
    Garantir Minha Vaga!
@endcomponent

<p>Para garantir a sua vaga, você tem até o dia {{ date('d/m/Y', strtotime($order->due_at)) }} para conseguir o seu desconto e pagar somente {{ number_format($order->value, 2, ',', '.') }} e ter acesso completo ao conteúdo do curso!</p>

@endcomponent