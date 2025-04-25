<x-guest-layout>


    <p>Content Here</p>

    {!! (new \App\Services\PesapalService())->customerTransaction(1, 'desc', auth()->user()->name, '', '', '', 'reference',
 $data['callback'], $data) !!}

</x-guest-layout>