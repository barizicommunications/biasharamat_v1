<x-guest-layout>


    <p>Content Here</p>

    {!! (new \App\Services\PesapalService())->customerTransaction($data['amount'], 'desc', auth()->user()->name, '', '', '', 'reference',
 $data['callback'], $data) !!}

</x-guest-layout>