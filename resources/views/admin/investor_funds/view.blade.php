@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')


<div class="container-fluid" dir="rtl" lang="ar">
    <div class="row justify-content-center">
        <div class="card p-4 shadow-sm border-0" style="background: #f4f4f4;">
            <div class="card-header p-2 bg-primary text-white arabic-text">
                <h3 class="mb-0 text-white">إسم الصندوق الإستثماري</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">اسم</strong>
                    <span class="text-secondary">{{ $investorFund->user->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">الفئة</strong>
                    <span class="text-secondary">{{ $investorFund->category->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">الشركات</strong>
                    <div class="d-flex flex-wrap">
                        @if($investorFund->companies->isNotEmpty())
                        <!-- Display the first 2 companies -->
                        @foreach ($investorFund->companies->take(0) as $company)
                        <span class="text-secondary badge bg-primary text-white me-2 mb-2">
                            {{ $company->name ?? 'Not Available' }}
                        </span>
                        @endforeach

                        <!-- Button to open the modal if there are more than 2 companies -->
                        @if($investorFund->companies->count() > 0)
                        <button type="button" class="text-secondary badge bg-primary text-white me-2 mb-2" data-bs-toggle="modal" data-bs-target="#companyModal">
                            See More
                        </button>
                        @endif
                        @else
                        <span class="text-secondary badge bg-warning">
                            Not Available
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="companyModal" tabindex="-1" aria-labelledby="companyModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="companyModalLabel">جميع الشركات</h5>
                                <button type="button" style="display: contents;" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-close btn-sm btn-primary"></i>
                                </button>
                            </div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>اسم الشركة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($investorFund->companies as $company)
                                    <tr>
                                        <td>{{ $company->name ?? 'Not Available' }}</td>
                                        <td>
                                            <a href="{{ route('admin.request.bike.view', $company->id) }}" class="btn-sm btn-primary" title="عرض">
                                                view
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">المستثمرون</strong>
                    <div class="d-flex flex-wrap">
                        <!-- Limit to 3 investors initially -->
                        @foreach ($investorRequest->take(0) as $request)
                        @if($request->user)
                        <!-- Check if user exists -->
                        <span class="text-secondary badge bg-primary text-white me-2 mb-2">
                            {{ $request->user->name ?? 'Not Available' }}
                        </span>
                        @endif
                        @endforeach

                        @if($investorRequest->count() > 0)
                        <!-- If there are more than 3 investors, show the button -->
                        <button class="text-secondary badge bg-primary text-white me-2 mb-2" data-bs-toggle="modal" data-bs-target="#modalId">
                            See More
                        </button>
                        @endif

                        @if($investorRequest->isEmpty())
                        <!-- Check if there are no requests -->
                        <span class="text-secondary badge bg-warning">
                            Not Available
                        </span>
                        @endif
                    </div>
                </div>


                <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content p-2">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    جميع المستثمرين
                                </h5>
                                <button type="button" style="display: contents;" data-bs-dismiss="modal" aria-label="Close">
                                    <i class="fa fa-close btn-sm btn-primary"></i>
                                </button>
                            </div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th style="font-size: 13px;">الاسم</th>
                                        <th style="font-size: 13px;">المبلغ</th>
                                        <th style="font-size: 13px;">نسبة الربح</th>
                                        <th style="font-size: 13px;">الربح المحسوب</th>
                                        <th style="font-size: 13px;">دفع المبلغ الإجمالي</th>
                                        <th style="font-size: 13px;">أضف المبلغ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($investorRequest as $request)
                                    @if($request->user)
                                    <tr>
                                        <td>{{ $request->user->name ?? 'Not Available' }}</td>
                                        <td>{{ $request->amount ?? 'Not Available' }}</td>
                                        <td>{{ $request->profitPercentage ?? 'Not Available' }}%</td>
                                        <td>{{ $request->calculatedProfit ?? 'Not Available' }}</td>
                                        <td>
                                            @php
                                                $userPayments = $request->payments;
                                                $totalPaid = $userPayments->sum('amount');
                                            @endphp
                                            {{ $totalPaid ?? 0 }}
                                        </td>
                                        <td><a href="" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#payment{{ $request->id }}"><i class="fas fa-money-bill paymentIcon text-white"></i>Pay</a></td>
                                        <div class="modal fade" id="payment{{ $request->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content p-2">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">
                                                            مبلغ الدفع
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.investor.funds.payment', $request->investor_funds_id) }}" method="POST">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <input type="hidden" name="user_id" value="{{ $request->user_id }}" id="input-{{ $request->id }}">
                                                                <input type="hidden" name="created_by" value="{{ auth()->user()->id ?? '' }}" id="">
                                                                <input type="hidden" name="investor_funds_id" value="{{ $request->investor_funds_id ?? '' }}" id="">
                                                                <label for="">كمية</label>
                                                                <input type="number" placeholder="Amount" class="form-control" name="amount" id="">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">يُقدِّم</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">إجمالي الصناديق</strong>
                    <span class="text-secondary">{{ $investorFund->total_funds ?? 'Not Available' }}.00</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">إجمالي الأموال المستلمة</strong>
                    <span class="text-secondary">{{ $amountSum ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">الحالة</strong>
                    @if($investorFund->status == 0)
                    <span class="badge bg-success" data-bs-toggle="modal" data-bs-target="#statusModal{{ $investorFund->id }}">Investment not completed</span>
                    @elseif($investorFund->status == 3)
                    <span class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#statusModal{{ $investorFund->id }}">Waiting Investors</span>
                    @elseif($investorFund->status == 2)
                    <span class="badge bg-primary" data-bs-toggle="modal" data-bs-target="#statusModal{{ $investorFund->id }}">Started
                        <span>📅 {{ $investorFund->updated_at ? $investorFund->updated_at->format('d M, Y') : '' }}</span> @elseif($investorFund->status == 1)
                        <span class="badge bg-success" data-bs-toggle="modal" data-bs-target="#statusModal{{ $investorFund->id }}">Completed</span>
                        @elseif($investorFund->status == 4)
                        <span class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#statusModal{{ $investorFund->id }}">Rejected</span>
                        @endif
                </div>

                <!-- Modal for Status Update -->
                <div class="modal fade" id="statusModal{{ $investorFund->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content p-2">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    تحديث حالة الشركة
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body mt-3">
                                <form action="{{ route('admin.investor.funds.status', $investorFund->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="status{{ $investorFund->id }}" class="form-label">حالة الشركة</label>
                                        <select name="status" id="status{{ $investorFund->id }}" class="form-control">
                                            <option value="" disabled selected>حالة الشركة</option>
                                            <option value="0" {{ $investorFund->status == 0 ? 'selected' : '' }}>Investment not completed</option>
                                            <option value="3" {{ $investorFund->status == 3 ? 'selected' : '' }}>Waiting Investors</option>
                                            <option value="2" {{ $investorFund->status == 2 ? 'selected' : '' }}>Started</option>
                                            <option value="1" {{ $investorFund->status == 1 ? 'selected' : '' }}>Completed</option>
                                            <option value="4" {{ $investorFund->status == 4 ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">نسبة الربح</strong>
                    <span class="text-secondary">{{ $investorFund->profit_percentage ?? 'Not Available' }}%</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">مدة الاستثمار</strong>
                    <span class="text-secondary">{{ $investorFund->duration_of_investment ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">سيتم دفع الربح</strong>
                    <span class="text-secondary">{{ $investorFund->profit ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">بداية الفترة</strong>
                    <span class="text-secondary">{{ $investorFund->start_of_period ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">نهاية الفترة</strong>
                    <span class="text-secondary">{{ $investorFund->end_of_period ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">صورة</strong>
                    <span class="text-secondary">
                        @if(!empty($investorFund->image))
                        <img src="{{ asset('investorFund/' . $investorFund->image) }}" alt="Investor Fund Image" height="60px" width="60px">
                        @else
                        <p>Image not found</p>
                        @endif
                    </span>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">تم الإنشاء في: {{ $investorFund->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>

@endsection
