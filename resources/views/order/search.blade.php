<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{route('dashboard')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full float-right">
                Back
            </a>
            <div class="relative rounded-xl overflow-auto">
                <div class="shadow-sm overflow-hidden my-8">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead>
                        <tr>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Id</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pl-8 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Product Name</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Product Quantity</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Total Price</th>
                            <th class="border-b dark:border-slate-600 font-medium p-4 pt-0 pb-3 text-slate-400 dark:text-slate-200 text-left">Created At</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800">
                        @foreach($order as $item)
                            <tr>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{$item->id}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{$item->product->name}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{$item->product_qty}}</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{$item->total_price}}$</td>
                                <td class="border-b border-slate-100 dark:border-slate-700 p-4 pl-8 text-slate-500 dark:text-slate-400">{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

