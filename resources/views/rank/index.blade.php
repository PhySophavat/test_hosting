<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Khmer Title Hidden --}}
    {{-- <title>តារាងពិន្ទុសិស្ស - ថ្នាក់ {{ $className }}</title> --}}

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Khmer Font -->
    <link href="https://fonts.googleapis.com/css2?family=Battambang&display=swap" rel="stylesheet">

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <style>
        body { 
            font-family: 'Battambang', sans-serif; 
        }
        @media print {
            body { 
                background: white !important; 
                margin: 0; 
                padding: 0; 
            }
            .no-print { 
                display: none !important; 
            }
            table { 
                border-collapse: collapse; 
                width: 100%; 
            }
            th, td { 
                border: 1px solid black !important; 
                padding: 4px; 
            }
            .container { 
                box-shadow: none !important; 
                max-width: 100% !important; 
                padding: 0 !important; 
            }

            /* Forcefully suppress browser headers/footers */
            @page {
                size: auto;
                margin: 0mm; /* Explicitly set to 0 */
            }

            /* Ensure no background images with URLs are printed */
            * {
                background-image: none !important;
            }

            /* Hide any elements that might contain URLs in text or attributes */
            img, [style*="url"], [src*="http"], [href*="http"] {
                display: none !important; /* Hide images or elements with URLs */
            }
        }
    </style>
</head>
<body>

<div class="container mx-auto bg-white shadow-md rounded-xl p-6 text-sm print:p-0 print:shadow-none print:rounded-none" style="max-width: 1100px;">

    <!-- ===== Header ===== -->
    <div class="text-center mb-6 leading-relaxed  print:mt-10">
        <p class="text-xs">ព្រះរាជាណាចក្រកម្ពុជា</p>
        <p class="text-xs">ជាតិ សាសនា ព្រះមហាក្សត្រ</p>
        <p class="my-1">✻✻✻✻✻</p>
        <p class="font-semibold text-xs">សាលា.......................................</p>
        <p class="mt-2 font-bold text-lg">តារាងពិន្ទុសិស្ស</p>
        <!-- Class/Year only visible on screen -->
        <p class="mt-1 text-gray-700 no-print">
            ថ្នាក់ទី {{ $className }} ឆ្នាំសិក្សា {{ $selectedYear ?? date('Y') }}
        </p>
    </div>

    <!-- ===== Filters (Hidden on print) ===== -->
    <div class="mb-4 flex justify-end items-center gap-3 no-print">
        <form method="GET" action="{{ route('rank.index', $className) }}" class="flex items-center gap-2">
            <label for="month">ខែ:</label>
            <select id="month" name="month"
                class="border border-gray-300 rounded-md px-2 py-1 text-xs focus:ring focus:ring-blue-200"
                onchange="this.form.submit()">
                <option value="">ទាំងអស់</option>
                @foreach([
                    1 => 'មករា', 2 => 'កុម្ភៈ', 3 => 'មីនា', 4 => 'មេសា',
                    5 => 'ឧសភា', 6 => 'មិថុនា', 7 => 'កក្កដា', 8 => 'សីហា',
                    9 => 'កញ្ញា', 10 => 'តុលា', 11 => 'វិច្ឆិកា', 12 => 'ធ្នូ'
                ] as $num => $name)
                    <option value="{{ $num }}" {{ $selectedMonth == $num ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            <label for="year" class="ml-2">ឆ្នាំ:</label>
            <input type="number" name="year" id="year"
                class="border border-gray-300 rounded-md px-2 py-1 w-20 text-xs focus:ring focus:ring-blue-200"
                value="{{ $selectedYear ?? date('Y') }}"
                onchange="this.form.submit()">
        </form>
    </div>

    <!-- ===== Table ===== -->
    <div class="overflow-x-auto print:px-10">
        <table class="w-full border border-gray-400 text-xs text-center print:px-6">
            <thead class="bg-gray-100 text-gray-800 font-semibold">
                <tr class="border-b border-gray-400">
                    <th rowspan="2" class="border px-2 py-1 w-8">ល.រ</th>
                    <th rowspan="2" class="border px-2 py-1 text-left">គោត្តនាម និងនាម</th>
                    <th rowspan="2" class="border px-2 py-1">ភេទ</th>
                    <th colspan="10" class="border px-2 py-1">មុខវិជ្ជា</th>
                    <th rowspan="2" class="border px-2 py-1 w-16">សរុប</th>
                    <th rowspan="2" class="border px-2 py-1 w-12">ចំណាត់</th>
                </tr>
                <tr class="border-b border-gray-400">
                    @foreach(['គណិត', 'ខ្មែរ', 'អង់គ្លេស', 'ប្រវត្តិ', 'ភូមិ', 'គីមី', 'រូប', 'ជីវ', 'សីលធម៌', 'កីឡា'] as $subject)
                        <th class="border px-2 py-1">{{ $subject }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @forelse($rankedStudents as $row)
                    @php $subject = $row['subject'] ?? null; @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                        <td class="border px-2 py-1 text-left">{{ $row['student']->user->name ?? 'N/A' }}</td>
                        <td class="border px-2 py-1">
                            @php
                                $gender = strtolower($row['student']->gender ?? '');
                                echo in_array($gender, ['male', 'ប្រុស', 'm', '1', 'boy']) ? 'ប្រុស' :
                                     (in_array($gender, ['female', 'ស្រី', 'f', '2', 'girl']) ? 'ស្រី' : '');
                            @endphp
                        </td>
                        <td class="border px-2 py-1">{{ $subject->math ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->khmer ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->english ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->history ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->geography ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->chemistry ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->physics ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->biology ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->ethics ?? '' }}</td>
                        <td class="border px-2 py-1">{{ $subject->sports ?? '' }}</td>
                        <td class="border px-2 py-1 font-semibold text-blue-700">{{ $row['total'] ?? '' }}</td>
                        <td class="border px-2 py-1 font-semibold text-red-600">{{ $row['rank'] ?? '' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="border px-2 py-4 text-gray-500">មិនមានទិន្នន័យសិស្សសម្រាប់ថ្នាក់នេះទេ</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- ===== Statistics ===== -->
    <div class="mt-4 flex gap-8 text-xs print:px-10">
        <p><strong>សិស្សសរុប:</strong> {{ $stats['total_students'] ?? 0 }} នាក់</p>
        <p><strong>ប្រុស:</strong> {{ $stats['male_count'] ?? 0 }} នាក់</p>
        <p><strong>ស្រី:</strong> {{ $stats['female_count'] ?? 0 }} នាក់</p>
    </div>

    <!-- ===== Signature Section ===== -->
    <div class="mt-10 grid grid-cols-2 gap-10 text-xs print:px-10">
        <div class="text-center">
            <p>ថ្ងៃទី....... ខែ........... ឆ្នាំ.........</p>
            <p class="font-bold mt-12">គ្រូបង្រៀន</p>
            <p class="mt-1">(ឈ្មោះ និងហត្ថលេខា)</p>
        </div>
        <div class="text-center print:px-10">
            <p>ថ្ងៃទី....... ខែ........... ឆ្នាំ.........</p>
            <p class="font-bold mt-12">នាយកសាលា</p>
            <p class="mt-1">(ឈ្មោះ និងហត្ថលេខា)</p>
        </div>
    </div>

    <!-- ===== Buttons (Hidden on print) ===== -->
    <div class="mt-6 text-center no-print">
        {{-- <p class="text-xs text-gray-600 mb-2">ចំណាំ: ដើម្បីលទ្ធផលបោះពុម្ពល្អបំផុត សូមបិទ "Headers and Footers" នៅក្នុងការកំណត់បោះពុម្ព។</p> --}}
        <a href="{{ route('result.index') }}"
            class="inline-block bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition text-xs">
            ← ត្រឡប់ក្រោយ
        </a>
        <button id="printButton"
            class="inline-block bg-green-600 text-white px-5 py-2 rounded-md hover:bg-green-700 transition text-xs ml-2">
            🖨️ បោះពុម្ព
        </button>
    </div>

</div>

<script>
$(document).ready(function() {
    $('#printButton').click(function() {
        // Hide elements with .no-print class before printing
        $('.no-print').hide();
        // Trigger print
        window.print();
        // Show elements again after print
        $('.no-print').show();
    });
});
</script>

</body>
</html>