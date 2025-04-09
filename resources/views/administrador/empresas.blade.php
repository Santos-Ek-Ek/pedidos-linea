@extends('administrador.layout.app')
@section('titulo', 'Empresas')
@section('content')
<div class="container-fluid">
        <!-- Content Header (Page header) -->
    <div class="content-header">
          <form class="form-inline">
            <div class="input-group">
              <input class="form-control " type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
    </div>
    <!-- /.content-header -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">DataTable with minimal features & hover style</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre Dueño</th>
                    <th>Empresa</th>
                    <th>Dirección</th>
                    <th>Acción</th>
                  </tr>
                  </thead>
                  <tbody>
                
                  <tr>
                    
                    <td style="vertical-align: middle; text-align: center;"><span>1</span></td>
                    <td style="vertical-align: middle; text-align: center;"><span>---</span></td>
                    <td style="vertical-align: middle; text-align: center;"><span> --- </span></td>
                    <td style="vertical-align: middle; text-align: center;"><span> --- </span></td>
                    <td ><i class="fas fa-trash" >  </i></td>
                  </tr>
            
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nombre Dueño</th>
                    <th>Empresa</th>
                    <th>Dirección</th>
                    <th>Acción</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>

      @endsection
