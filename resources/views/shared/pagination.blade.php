@if ($paginator->hasPages())
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-end">
                  @if ($paginator->onFirstPage())
                      <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1"><i class="ti-arrow-left"></i></a>
                      </li>
                  @else
                  
                    @isset($search)
                      <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}&search={{$search}}" rel="next"><i class="ti-arrow-left"></i></a>
                      </li>    
                    @else
                    <li class="page-item">
                      <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="ti-arrow-left"></i></a></li>
                    </li>
                    @endisset
                      
                  @endif
                
                  @foreach ($elements as $element)
                      @if (is_string($element))
                          <li class="page-item disabled">{{ $element }}</li>
                      @endif
                      @if (is_array($element))
                          @foreach ($element as $page => $url)
                              @if ($page == $paginator->currentPage())
                                  <li class="page-item active">
                                      <a class="page-link">{{ $page }}</a>
                                  </li>                                
                              @else
                                    @isset($search)
                                        <li class="page-item">
                                            <a class="page-link" href=" {{ $url }}&search={{$search}}">{{ $page }}</a>
                                        </li> 
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href=" {{ $url }}">{{ $page }}</a>
                                        </li>     
                                    @endisset
                                  
                              @endif
                          @endforeach
                      @endif
                  @endforeach
                  
                  @if ($paginator->hasMorePages())
                    @isset($search)
                      <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}&search={{$search}}" rel="next"><i class="ti-arrow-right"></i></a>
                      </li>    
                    @else
                    <li class="page-item">
                      <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="ti-arrow-right"></i></a>
                    </li>
                    @endisset
                      
                  @else
                      <li class="page-item disabled">
                          <a class="page-link" href="#"><i class="ti-arrow-right"></i></a>
                      </li>
                  @endif
              </ul>

            @endif