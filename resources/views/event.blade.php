@extends('layouts.main')
@section('title', 'Evento Tal')

@section('content')

    <!-- Hero -->
    <div class="container py-3">
        <img src="/img/evento_1.jpg" class="img-fluid rounded" alt="...">
    </div>

    <!-- Nome do evento -->
    <div class="container py-3">
        <h1>Evento tal</h1>

        <p>
            <ion-icon name="time-outline"></ion-icon> 07:00 as 18:00
        </p>

        <p>
            <ion-icon name="location-outline"></ion-icon> Araújo Vianna - Parque Farroupilha, 685, Porto Alegre - Rio Grande do Sul
        </p>

        <p>
            <ion-icon name="heart-outline"></ion-icon> Lembre-se das medidas de prevenção ao COVID-19.
        </p>

        <h2>Descrição do evento</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed ullamcorper morbi tincidunt ornare massa. In hac habitasse platea dictumst vestibulum rhoncus est. Turpis egestas integer eget aliquet nibh. Tempus quam pellentesque nec nam aliquam. Sit amet justo donec enim diam vulputate ut pharetra sit. Potenti nullam ac tortor vitae purus. Viverra maecenas accumsan lacus vel facilisis volutpat. Sem et tortor consequat id porta nibh venenatis cras. Nunc pulvinar sapien et ligula ullamcorper malesuada proin.
        </p>
    </div>

    <!-- Covid -->
    <!-- Espaçador -->
    <div class="bg-danger">
        <div class="container px-3">
            <p class="text-white" >
            <br><br>
                <strong>PARA EVENTOS PRESENCIAIS</strong> <br>
                Fique ligado! A segurança é responsabilidade de todos.
            </p>
            <div class="row d-flex align-items-center text-center g-2 p-3">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
                    <div class="card text-dark bg-light" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><ion-icon size="large" style="color: #e3342f" name="warning-outline"></ion-icon></h5>
                            <p class="card-text">Ao frequentar um evento neste período de pandemia provocado pela COVID-19, você está ciente e assume os riscos de saúde envolvidos.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
                    <div class="card text-dark bg-light" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><ion-icon size="large" style="color: #e3342f" name="medkit-outline"></ion-icon></h5>
                            <p class="card-text">A adoção dos protocolos de saúde e segurança pelo local e pelos participantes visa mitigar os riscos de exposição e contaminação pelo coronavírus.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                    <div class="card text-dark bg-light" style="max-width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><ion-icon size="large" style="color: #e3342f" name="fitness-outline"></ion-icon></h5>
                            <p class="card-text">Use máscara, mantenha o distanciamento, higienize as mãos com frequência e se informe sobre as normas de segurança vigentes na cidade do evento.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection