<x-form method="get">
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="mb-3">
                <x-input name="search" value="{{ request('search') }}" placeholder="{{__('Поиск')}}"/>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="mb-3">
                <x-form.select name="categories_id[]" multiple>
                    @foreach($categories as $category)
                        <option @if(in_array($category->id, old('categories_id', []))) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="mb-3">
                <x-button type="submit">
                    {{__('Применить')}}
                </x-button>
            </div>
        </div>
    </div>
</x-form>
