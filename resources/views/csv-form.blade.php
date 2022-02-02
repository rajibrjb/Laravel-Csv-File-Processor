
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Amran Ahamed, Csv Uploader">
    <meta name="generator" content="Hugo 0.88.1">


    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/jumbotron/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Favicons -->


<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>


  </head>
  <body>

<main>
    {{-- {{ session('csv_data') }} --}}
  <div class="container py-4">
    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Upload New CSV</h1>
        <form method="post" action="{{ route('csv.store') }}" enctype="multipart/form-data"> @csrf
            <div class="custom-file">
                <input type="file" accept=".csv" name="excel" class="custom-file-input" id="customFile" />
                <label class="custom-file-label" for="customFile">Choose file</label	>
                </div>
                <div>
                    <button  type="submit" class="btn btn-primary btn-lg mt-2" type="button">Upload Csv</button>

        </form>

      </div>
    </div>

    @isset($csv_data)
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Date</th>
          <th>TransactionNumber</th>
          <th>CustomerNumber</th>
          <th>Reference</th>
          <th>Amount</th>
        </tr>
        </thead>
        <tbody>

        @forelse($csv_data as $data)
        <tr>
          <td>
              {{ $data['Date'] ?? '' }}
          </td>
          <td @class([
            'text-danger' =>  $data['Verified'],
        ])>
              {{ $data['TransactionNumber'] ?? '' }}
          </td>
          <td>
            {{ $data['CustomerNumber'] ?? '' }}
          </td>
          <td>
            {{ $data['Reference'] ?? '' }}
          </td>
          <td>
            {{ $data['Amount'] ?? '' }}
          </td>
        </tr>
        @empty
        <p>No categories found</p>
        @endforelse
      </tbody>

    </table>
    @endisset

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022
    </footer>
  </div>
</main>



  </body>
</html>
